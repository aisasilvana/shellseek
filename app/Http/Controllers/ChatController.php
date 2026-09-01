<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Services\FlaskAgentService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct(protected FlaskAgentService $agent)
    {
    }

    public function index()
    {
        $conversation = Conversation::first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'title' => 'Sesi baru',
                'target' => 'latihan-lab.local',
            ]);
        }

        return view('chat.index', [
            'conversation' => $conversation,
            'messages' => $conversation->messages()->orderBy('id')->get(),
        ]);
    }

    public function send(Request $request, Conversation $conversation)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'user',
            'type' => 'text',
            'content' => $request->message,
        ]);

        $suggestion = $this->agent->suggest($request->message, $conversation->target);

        Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'assistant',
            'type' => 'command_suggestion',
            'content' => $suggestion['content'],
            'command_text' => $suggestion['command'],
            'status' => 'pending',
            'agent' => $suggestion['agent'],
        ]);

        return redirect()->route('chat.index');
    }

    public function executeCommand(Message $message)
    {
        abort_unless($message->type === 'command_suggestion' && $message->status === 'pending', 404);

        $message->update([
            'status' => 'executed',
            'execution_output' => "22/tcp open  ssh     OpenSSH 8.9\n80/tcp open  http    nginx 1.24.0",
        ]);

        return redirect()->route('chat.index');
    }

    public function cancelCommand(Message $message)
    {
        abort_unless($message->type === 'command_suggestion' && $message->status === 'pending', 404);

        $message->update(['status' => 'cancelled']);

        return redirect()->route('chat.index');
    }
}