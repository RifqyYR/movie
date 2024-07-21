@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h5 mb-0 text-gray-800" style="color: #ff8000 !important;">Notes: <span
                    style="font-size: 1.1rem">{{ Carbon\Carbon::now()->format('d-m-Y') }}</span></h1>
        </div>

        <div class="row">
            @if ($usersWithNotes->isEmpty())
                <div class="row mt-4">
                    <span class="text-center">
                        Belum ada catatan
                    </span>
                </div>
            @else
                @foreach ($usersWithNotes as $item)
                    @php
                        $images = [
                            url('backend/img/undraw_profile.svg'),
                            url('backend/img/undraw_profile_1.svg'),
                            url('backend/img/undraw_profile_2.svg'),
                            url('backend/img/undraw_profile_3.svg'),
                        ];
                        $randomImage = $images[array_rand($images)];
                    @endphp
                    <div class="col-md-4 mb-3">
                        <div class="card notes-card">
                            <div class="card-header bg-blue notes-card-header">
                                <img class="img-profile rounded-circle" width="30" src="{{ $randomImage }}">
                                <span class="ms-2" style="font-size: 0.9rem;">{{ $item->name }}</span>
                            </div>
                            <div class="card-body notes-card-body">
                                @foreach ($item->notes as $note)
                                    <div class="d-flex align-items-start">
                                        <span class="list-item me-2 align-self-start py-1">{{ $loop->index + 1 }}</span>
                                        <p class="m-0 list-item flex-grow-1 align-self-start py-1">{{ $note->content }}</p>
                                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" clas py-1>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0"
                                                style="color: red; text-decoration: none; border: none;">
                                                <svg class="align-self-start" xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" viewBox="0 0 384 512">
                                                    <path fill="#ff0000"
                                                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
