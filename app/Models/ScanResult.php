<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScanResult extends Model
{
    use HasFactory;

    protected $fillable = ['conversation_id', 'target', 'port', 'service', 'version'];

    public function vulnerabilities(): HasMany
    {
        return $this->hasMany(Vulnerability::class);
    }
}