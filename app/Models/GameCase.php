<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GameCase extends Model
{
    protected $table =  'cases';
    protected $fillable = [
        'title',
        'description',
    ];

    public function scenarios(): HasMany
    {
        return $this->hasMany(scenario::class,'case_id');
    }

    public function characteres(): HasMany 
    {
        return $this->hasMany(Character::class);
    }

    public function clues(): HasMany 
    {
        return $this->hasMany(Clue::class);
    }
}
