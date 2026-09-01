<?php

namespace App\Http\Controllers;

use App\Models\ReconResult;
use Illuminate\Http\Request;

class ReconController extends Controller
{
    public function index()
    {
        $lastUsername = ReconResult::latest()->value('username');

        $results = $lastUsername
            ? ReconResult::where('username', $lastUsername)->latest()->get()
            : collect();

        return view('recon.index', [
            'username' => $lastUsername,
            'results' => $results,
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
        ]);

        $platforms = $this->checkUsername($request->username);

        foreach ($platforms as $p) {
            ReconResult::create([
                'username' => $request->username,
                'platform' => $p['platform'],
                'profile_url' => $p['url'],
                'found' => $p['found'],
            ]);
        }

        return redirect()->route('recon.index');
    }

    protected function checkUsername(string $username): array
    {
        // MOCK — nanti bisa diganti manggil Flask, atau cek beneran ke tiap platform
        return [
            ['platform' => 'GitHub', 'found' => true, 'url' => "https://github.com/{$username}"],
            ['platform' => 'Instagram', 'found' => true, 'url' => "https://instagram.com/{$username}"],
            ['platform' => 'Twitter / X', 'found' => true, 'url' => "https://x.com/{$username}"],
            ['platform' => 'LinkedIn', 'found' => false, 'url' => null],
            ['platform' => 'TikTok', 'found' => false, 'url' => null],
        ];
    }
}