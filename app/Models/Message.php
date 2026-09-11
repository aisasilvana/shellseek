<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
    'conversation_id', 'role', 'type', 'content',
    'command_text', 'execution_output', 'status', 'agent', 'scope_status',
];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }
}