<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReconController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ScanController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// Halaman auth — bisa diakses siapa saja (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman sistem — WAJIB sudah login
Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/{conversation}/send', [ChatController::class, 'send'])->name('chat.send');
    Route::post('/chat/message/{message}/execute', [ChatController::class, 'executeCommand'])->name('chat.execute');
    Route::post('/chat/message/{message}/cancel', [ChatController::class, 'cancelCommand'])->name('chat.cancel');

    Route::get('/recon', [ReconController::class, 'index'])->name('recon.index');
    Route::post('/recon/search', [ReconController::class, 'search'])->name('recon.search');

    Route::get('/scan', [ScanController::class, 'index'])->name('scan.index');
    Route::post('/scan/run', [ScanController::class, 'scan'])->name('scan.run');

    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
});