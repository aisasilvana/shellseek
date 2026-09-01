<?php

namespace App\Services;

class FlaskAgentService
{
    public function suggest(string $message, ?string $target = null): array
    {
        $message = strtolower($message);
        $target = $target ?: 'target.local';

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

        // default, kalau tidak ada kata kunci yang cocok
        return [
            'content' => 'Saya belum yakin maksudnya apa, tapi coba cek koneksi ke target dulu.',
            'command' => "ping {$target}",
            'agent' => 'assistant',
        ];
    }
}