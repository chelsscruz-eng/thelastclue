<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Scenario extends Model
{
    protected $fillable = [
        'case_id',
        'name',
        'description',
    ];

    public function gameCase(): BelongsTo 
    {
        return $this->belongsTo(GameCase::class, 'case_id');
    }
}
