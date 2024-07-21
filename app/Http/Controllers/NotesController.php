<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Notes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class NotesController extends Controller
{
    public function index()
    {
        $usersWithNotes = User::with('notes')->get()->filter(function ($user) {
            return $user->notes->isNotEmpty();
        });
        
        return view('pages.notes.notes', compact('usersWithNotes'));
    }

    public function store(string $claim_uuid)
    {
        try {
            $claim = Claim::where('uuid', $claim_uuid)->first();
            $now = Carbon::now();

            $your_date = Carbon::parse($claim->created_date);
            $completion_limit_date = Carbon::parse($claim->file_completeness);
            
            $content = '';

            if ($claim->level == 'FKTP') {
                $datediff = $your_date->diffInWeekdays($now);
                $dateDiffFinance = $completion_limit_date->diffInWeekdays($now);

                $holidays = config('app.holidays');
                foreach ($holidays as $holiday) {
                    $holidayDate = Carbon::parse($holiday);
                    if ($holidayDate->isWeekDay()) {
                        if ($holidayDate->between($your_date, $now)) {
                            $datediff--;
                        }
                        if ($holidayDate->between($completion_limit_date, $now)) {
                            $dateDiffFinance--;
                        }
                    }
                }

                if ($claim->status == Claim::STATUS_BA_SERAH_TERIMA) {
                    $datediff++;
                    $content = $claim->hospital_name . ' ' . $claim->claim_type .  ' ' . $claim->month . ' hari ke-' . $datediff;
                } else {
                    $dateDiffFinance++;
                    $content = $claim->hospital_name . ' ' . $claim->claim_type .  ' ' . $claim->month . ' hari ke-' . $dateDiffFinance;
                }
            } else {
                $datediff = $your_date->diffInDays($now);
                $dateDiffFinance = $completion_limit_date->diffInDays($now);

                if ($claim->status == Claim::STATUS_BA_SERAH_TERIMA) {
                    $datediff++;
                    $content = $claim->hospital_name . ' ' . $claim->claim_type .  ' ' . $claim->month . ' hari ke-' . $datediff;
                } else {
                    $dateDiffFinance++;
                    $content = $claim->hospital_name . ' ' . $claim->claim_type .  ' ' . $claim->month . ' hari ke-' . $dateDiffFinance;
                }
            }
                    
            Notes::create([
                'uuid' => Uuid::uuid4(),
                'user_uuid' => Auth::user()->uuid,
                'content' => $content,
            ]);

            return redirect()->route('notes.index')->with('success', 'Berhasil membuat note baru');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan notes: ' . $e->getMessage());
        }
    }

    public function destroy(Notes $note)
    {
        try {
            $this->authorize('delete', $note);
            $note->delete();
            return redirect()->back()->with('success', 'Note deleted successfully');
        } catch (AuthorizationException $e) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus note user lain');
        }
    }

    public function deleteAllNotes()
    {
        Notes::truncate();
    }
}
