<?php

namespace App\Repositories;

use App\Models\Character;

class CharacterRepository
{
    public function getAll()
    {
        return Character::orderBy('id')->get();
    }

    public function getById($id)
    {
        return Character::findOrFail($id);
    }

    public function getByCase($caseId)
    {
        return Character::where('case_id', $caseId)
            ->orderBy('id')
            ->get();
    }

    public function create($data)
    {
        return Character::create($data);
    }

    public function update($id, $data)
    {
        $character = Character::findOrFail($id);
        $character->update($data);

        return $character; 
    }

    public function delete($id)
    {
        $character = Character::findOrFail($id);
        $character->delete();
    }
}