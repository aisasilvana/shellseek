<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReconController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\VulnerabilityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(auth()->check() ? route('chat.index') : route('login'));
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{conversation}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/new', [ChatController::class, 'newChat'])->name('chat.new');
    Route::post('/chat/{conversation}/send', [ChatController::class, 'send'])->name('chat.send');
    Route::post('/chat/message/{message}/execute', [ChatController::class, 'executeCommand'])->name('chat.execute');
    Route::post('/chat/message/{message}/cancel', [ChatController::class, 'cancelCommand'])->name('chat.cancel');

    Route::get('/recon', [ReconController::class, 'index'])->name('recon.index');
    Route::post('/recon/search', [ReconController::class, 'search'])->name('recon.search');

    Route::get('/scan', [ScanController::class, 'index'])->name('scan.index');
    Route::post('/scan/run', [ScanController::class, 'scan'])->name('scan.run');

    Route::get('/vulnerability', [VulnerabilityController::class, 'index'])->name('vulnerability.index');

    Route::get('/report', [ReportController::class, 'index'])->name('report.index');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
});