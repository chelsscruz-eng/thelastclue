<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Dialogue extends Model
{
    protected $fillable = [
        'character_id',
        'question',
        'answer',
        'clue_id',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    public function clue(): BelongsTo 
    {
        return $this->belongsTo(Clue::class);
    }
}
