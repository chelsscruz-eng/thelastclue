<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Clue extends Model
{
    protected $fillable = [
        'case_id',
        'scenario_id',
        'name',
        'description',
    ];

    public function gameCase(): BelongsTo
    {
        return $this->belongsTo(GameCase::class, 'case_id');
    }

    public function scenario(): BelongsTo
    {
        return $this->belongsTo(Scenario::class);
    }
}
