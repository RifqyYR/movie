<?php

use App\Http\Controllers\AbsensiClaimController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\UserController;
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
  Route::get('/claim/approve-kabag/{id}', [ClaimController::class, 'approveHead'])->name('claim.approve.head');
  Route::get('/claim/approve-keuangan/{id}', [ClaimController::class, 'approveFinance'])->name('claim.approve.finance');

  // User Management
  Route::get('/user', [UserController::class, 'index'])->name('user');
  Route::get('/user-edit/{user:uuid}', [UserController::class, 'edit'])->name('user.edit');
  Route::post('/proses-edit-user', [UserController::class, 'editProcess'])->name('edit.user.proses');
  Route::get('/delete-user/{id}', [UserController::class, 'delete'])->name('delete.user.proses');

  // Hapus Claim
  Route::get('/claim/hapus/{id}', [ClaimController::class, 'delete'])->name('claim.delete');
});

Route::middleware(['auth', 'verified', 'verificator'])->group(function () {
  Route::get('/claim/buat', [ClaimController::class, 'showCreatePage'])->name('claim.create.show');
  Route::post('/claim/proses-buat-claim', [ClaimController::class, 'createProcess'])->name('claim.create');
  Route::get('/claim/approve-verifikator/{id}', [ClaimController::class, 'approveVerificator'])->name('claim.approve.verificator');
});

Route::middleware(['auth', 'verified', 'head'])->group(function () {
  Route::get('/claim/approve-kabag/{id}', [ClaimController::class, 'approveHead'])->name('claim.approve.head');
});

Route::middleware(['auth', 'verified', 'staff'])->group(function () {
  Route::post('/claim/approve-staff/{id}', [ClaimController::class, 'approveStaff'])->name('claim.approve.staff');

  // Edit Claim
  Route::get('/claim/edit/{id}', [ClaimController::class, 'showEditPage'])->name('claim.edit.show');
  Route::post('/claim/edit', [ClaimController::class, 'edit'])->name('claim.edit.process');
});

Route::middleware(['auth', 'verified', 'finance'])->group(function () {
  Route::get('/claim/approve-keuangan/{id}', [ClaimController::class, 'approveFinance'])->name('claim.approve.finance');
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
  
  Route::get('/telegram/example', [TelegramController::class, 'callback'])->name('telegram.connect');
  Route::post('/message', [TelegramController::class, 'message']);
});

Auth::routes(['verify' => false, 'register' => false, 'reset' => false]);
