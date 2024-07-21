<?php

use App\Http\Controllers\AbsensiClaimController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\UserController;
use App\Models\Archive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
  // Register
  Route::get('/register', [RegisterController::class, 'register'])->name('register');
  Route::post('/proses-register', [RegisterController::class, 'registerProcess'])->name('proses.register');

  // Approval
  Route::get('/claim/approve-verifikator/{id}', [ClaimController::class, 'approveVerificator'])->name('claim.approve.verificator');
  Route::get('/claim/approve-kabag/{id}', [ClaimController::class, 'approveHeadSingle'])->name('claim.approve.head-single');
  Route::get('/claim/approve-keuangan/{id}', [ClaimController::class, 'approveFinanceSingle'])->name('claim.approve.finance-single');

  // User Management
  Route::get('/user', [UserController::class, 'index'])->name('user');
  Route::get('/user-edit/{user:uuid}', [UserController::class, 'edit'])->name('user.edit');
  Route::post('/proses-edit-user', [UserController::class, 'editProcess'])->name('edit.user.proses');
  Route::get('/delete-user/{id}', [UserController::class, 'delete'])->name('delete.user.proses');

  // Faskes Management
  Route::get('/faskes', [HospitalController::class, 'index'])->name('faskes');
  Route::get('/faskes/buat', [HospitalController::class, 'create'])->name('faskes.show-create');
  Route::get('/delete-faskes/{id}', [HospitalController::class, 'delete'])->name('faskes.delete');
  Route::post('/proses-tambah-faskes', [HospitalController::class, 'store'])->name('faskes.create');

  // Hapus Claim
  Route::get('/claim/hapus/{id}', [ClaimController::class, 'delete'])->name('claim.delete');
  
  // Hapus Arsip
  Route::get('/arsip/hapus/{id}', [ArchiveController::class, 'delete'])->name('archive.delete');
});

Route::middleware(['auth', 'verified', 'verificator'])->group(function () {
  Route::get('/claim/buat', [ClaimController::class, 'showCreatePage'])->name('claim.create.show');
  Route::post('/claim/proses-buat-claim', [ClaimController::class, 'createProcess'])->name('claim.create');
  Route::post('/claim/approve-verifikator/{id}', [ClaimController::class, 'approveVerificator'])->name('claim.approve.verificator');
  Route::post('/claim/approve-verifikator-complete/{id}', [ClaimController::class, 'approveVerificator'])->name('claim.approve.verificator-complete');
});

Route::middleware(['auth', 'verified', 'head'])->group(function () {
  Route::post('/claim/approve-kabag', [ClaimController::class, 'approveHead'])->name('claim.approve.head');
});

Route::middleware(['auth', 'verified', 'staff'])->group(function () {
  Route::post('/claim/approve-staff/{id}', [ClaimController::class, 'approveStaff'])->name('claim.approve.staff');

  // Edit Claim
  Route::get('/claim/edit/{id}', [ClaimController::class, 'showEditPage'])->name('claim.edit.show');
  Route::post('/claim/edit', [ClaimController::class, 'edit'])->name('claim.edit.process');
});

Route::middleware(['auth', 'verified', 'finance'])->group(function () {
  Route::post('/claim/approve-keuangan', [ClaimController::class, 'approveFinance'])->name('claim.approve.finance');
});

Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::get('/claim-absensi', [AbsensiClaimController::class, 'index'])->name('absent-claim');
  
  Route::get('/claim-fktp', [App\Http\Controllers\HomeController::class, 'fktp'])->name('claim.fktp');
  Route::get('/claim-fkrtl', [App\Http\Controllers\HomeController::class, 'fkrtl'])->name('claim.fkrtl');

  Route::get('/absensi-fktp/{wilayah}', [AbsensiClaimController::class, 'absensiFKTP'])->name('absensi.fktp');
  Route::get('/absensi-fkrtl/{wilayah}', [AbsensiClaimController::class, 'absensiFKRTL'])->name('absensi.fkrtl');
  
  Route::get('/history', [ClaimController::class, 'showHistoryPage'])->name('history');
  
  Route::get('/ganti-password/{user:uuid}', [UserController::class, 'changePassword'])->name('user.change-password');
  Route::post('/proses-ganti-password/{user:uuid}', [UserController::class, 'changePasswordProcess'])->name('user.change-password.process');

  Route::get('/claim/export-fkrtl', [ClaimController::class, 'export_fkrtl']);
  Route::get('/claim/export-fktp', [ClaimController::class, 'export_fktp']);
  Route::get('/claim/export-riwayat', [ClaimController::class, 'export_history']);
  
  Route::get('/arsip', [ArchiveController::class, 'index'])->name('archive');
  Route::get('/arsip/buat', [ArchiveController::class, 'create'])->name('archive.create');
  Route::post('/arsip/proses-buat-arsip', [ArchiveController::class, 'store'])->name('archive.store');
  Route::get('/arsip/export', [ArchiveController::class, 'excel'])->name('archive.export-excel');
  
  Route::get('/notes', [NotesController::class, 'index'])->name('notes.index');
  Route::get('/notes/{claim_uuid}', [NotesController::class, 'store'])->name('notes.store');
  Route::delete('/notes/{note}', [NotesController::class, 'destroy'])->name('notes.destroy');

  Route::get('/arsip/edit/{uid}', [ArchiveController::class, 'edit'])->name('archive.edit');
  Route::post('/arsip/proses-edit-arsip', [ArchiveController::class, 'update'])->name('archive.update');
  
  Route::get('/telegram/example', [TelegramController::class, 'callback'])->name('telegram.connect');
  Route::post('/message', [TelegramController::class, 'message']);

  Route::get('/home/data-pie', [HomeController::class, 'getDataPie']);
  Route::get('/home/data-bar-fkrtl', [HomeController::class, 'getDataBarFKRTL']);
  Route::get('/home/data-bar-fktp', [HomeController::class, 'getDataBarFKTP']);

  // Download Word
  Route::get('/claim/download/{uid}', [ClaimController::class, 'downloadWord']);
});

Auth::routes(['verify' => false, 'register' => false, 'reset' => false]);
