<?php

namespace App\Http\Controllers;

use App\Models\Conversation;

class RiwayatController extends Controller
{
    public function index()
    {
        $conversations = Conversation::withCount('messages')->latest()->get();

        return view('riwayat.index', [
            'conversations' => $conversations,
        ]);
    }
}