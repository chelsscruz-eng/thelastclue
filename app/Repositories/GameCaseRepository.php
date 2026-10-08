<?php

namespace App\Repositories;

use App\Models\GameCase;

class GameCaseRepository
{
    public function getAll()
    {
        return GameCase::orderBy('id')->get();
    }

    public function getById($id)
    {
        return GameCase::findOrFail($id);
    }

    public function create()
    {
        return GameCase::create($data);
    }

    public function update($id, $data)
    {
        $gameCase = GameCase::findOrFail($id);
        $gameCase->update($data);
        return $gameCase;
    }

    public function delete($id)
    {
        $gameCase = GameCase::findOrFail($id);
        $gameCase->delete();
    }
}