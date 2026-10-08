<?php

namespace App\Repositories;

use App\Models\Dialogue;

class DialogueRepository
{
    public function getAll()
    {
        return Dialogue::orderBy('id')->get();
    }

    public function getById($id)
    {
        return Dialogue::findOrFail($id);
    }

    public function getByCharacter($characterId)
    {
        return Dialogue::where('character_id', $characterId)
            ->orderBy('id')
            ->get();
    }

    public function create($data)
    {
        return Dialogue::create($data);
    }

    public function update($id, $data)
    {
        $dialogue = Dialogue::findOrFail($id);
        $dialogue->update($data);

        return $dialogue;
    }

    public function delete($id)
    {
        $dialogue = Dialogue::findOrFail($id);
        $dialogue->delete();
    }
}