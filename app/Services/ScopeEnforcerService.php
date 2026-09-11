<?php

namespace App\Services;

class ScopeEnforcerService
{
    /**
     * Daftar pola command yang DITOLAK total — berpotensi merusak sistem
     * atau jelas di luar scope pengujian yang wajar.
     */
    protected array $denyPatterns = [
        'rm -rf',
        'dd if=',
        'mkfs',
        'shutdown',
        'reboot',
        ':(){ :|:& };:', // fork bomb
        '> /dev/sda',
    ];

    /**
     * Daftar pola command yang butuh PERINGATAN tambahan — bukan berbahaya
     * secara sistem, tapi berpotensi menyerang target secara agresif/luas.
     */
    protected array $warningPatterns = [
        'nmap -A',
        '--script vuln',
        'hydra',
        'sqlmap',
        'metasploit',
        'msfconsole',
        '-p-', // nmap scan semua port, cukup berat & mencolok
    ];

    /**
     * Cek satu command, kembalikan status: 'deny', 'warning', atau 'allow'.
     */
    public function check(string $command): string
    {
        $command = strtolower($command);

        foreach ($this->denyPatterns as $pattern) {
            if (str_contains($command, strtolower($pattern))) {
                return 'deny';
            }
        }

        foreach ($this->warningPatterns as $pattern) {
            if (str_contains($command, strtolower($pattern))) {
                return 'warning';
            }
        }

        return 'allow';
    }

    /**
     * Pesan yang ditampilkan ke user, sesuai status.
     */
    public function message(string $status): string
    {
        return match ($status) {
            'deny' => 'Command ini ditolak sistem karena berada di luar scope yang diizinkan (berpotensi merusak sistem atau di luar target pengujian).',
            'warning' => 'Command ini cukup agresif/luas cakupannya. Pastikan target dan scope pengujian sudah benar sebelum menjalankan.',
            default => '',
        };
    }
}