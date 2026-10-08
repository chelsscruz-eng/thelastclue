<?php

namespace App\Repositories;

use App\Models\Clue;

class ClueRepository
{
    public function getAll()
    {
        return Clue::orderBy('id')->get();
    }

    public function getById($id)
    {
        return Clue::findOrFail($id);
    }

    public function getByScenario($scenarioId)
    {
        return Clue::where('scenario_id', $scenarioId)
            ->orderBy('id')
            ->get();
    }

    public function create($data)
    {
        return Clue::create($data);
    }

    public function update($id, $data)
    {
        $clue = Clue::findOrFail($id);
        $clue->update($data);

        return $clue;
    }

    public function delete($id)
    {
        $clue = Clue::findOrFail($id);
        $clue->delete();
    }
}