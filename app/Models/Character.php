<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Character extends Model
{
    protected $table = 'characteres';
    protected $fillable = [
        'case_id',
        'name',
        'description',
        'role'
    ];

    public function gameCase(): BelongsTo 
    {
        return $this->belongsTo(GameCase::class, 'case_id');
    }

    public function dialogues(): HasMany 
    {
        return $this->hasMany(Dialogue::class);
    }
}
