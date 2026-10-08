<?php

namespace App\Repositories;

use App\Models\Scenario;

class ScenarioRepository
{
    public function getAll()
    {
        return Scenario::orderBy('id')->get();
    }

    public function getById($id)
    {
        return Scenario::findOrFail($id);
    }

    public function getByCase($caseId)
    {
        return Scenario::where('case_id', $caseId)
             ->orderBy('id')
             ->get();
    }

    public function create($id, $data)
    {
        return Scenario::create($data);
    }

    public function update($id, $data)
    {
        $scenario = Scenario::findOrFail($id);
        $scenario->update($data);
        
        return $scenario;
    }

    public function delete($id)
    {
        $scenario = Scenario::findOrFail($id);
        $scenario->delete();
    }
}