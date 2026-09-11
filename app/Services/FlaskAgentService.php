<?php

namespace App\Services;

class FlaskAgentService
{
    public function suggest(string $message, ?string $target = null): array
    {
        $message = strtolower($message);
        $target = $target ?: 'target.local';

        // Contoh yang memicu DENY (command berbahaya/di luar scope)
        if (str_contains($message, 'hapus') || str_contains($message, 'format')) {
            return [
                'content' => 'Untuk menghapus data secara permanen, kamu bisa pakai command ini.',
                'command' => 'rm -rf /var/www/data',
                'agent' => 'scanning_agent',
            ];
        }

        // Contoh yang memicu WARNING (command agresif/cakupan luas)
        if (str_contains($message, 'kerentanan') || str_contains($message, 'vulnerability') || str_contains($message, 'vuln')) {
            return [
                'content' => 'Untuk cek kerentanan secara menyeluruh, saya siapkan scan dengan script vuln Nmap.',
                'command' => "nmap -A --script vuln {$target}",
                'agent' => 'scanning_agent',
            ];
        }

        // Contoh normal (ALLOW)
        if (str_contains($message, 'ip') || str_contains($message, 'alamat')) {
            return [
                'content' => 'Untuk melihat IP address di laptopmu sendiri, kamu bisa pakai command ini.',
                'command' => 'ipconfig',
                'agent' => 'recon_agent',
            ];
        }

        if (str_contains($message, 'port')) {
            return [
                'content' => 'Untuk cek port yang terbuka di target, saya siapkan scan pakai Nmap.',
                'command' => "nmap -sV -T4 {$target}",
                'agent' => 'scanning_agent',
            ];
        }

        if (str_contains($message, 'subdomain')) {
            return [
                'content' => 'Untuk cari subdomain dari sebuah domain, kamu bisa pakai tool ini.',
                'command' => "subfinder -d {$target}",
                'agent' => 'recon_agent',
            ];
        }

        // Default (ALLOW)
        return [
            'content' => 'Saya belum yakin maksudnya apa, tapi coba cek koneksi ke target dulu.',
            'command' => "ping {$target}",
            'agent' => 'assistant',
        ];
    }
}