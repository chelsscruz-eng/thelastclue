<?php

namespace App\Http\Controllers;

use App\Models\Clue;
use App\Models\Scenario;
use App\Models\GameCase;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ClueController extends Controller
{
    public function index(): View
    {
        $clues = Clue::all();
        return view('clues.index', compact('clues'));
    }

    public function create()
    {
        $cases = GameCase::all();
        $scenarios = Scenario::all();

        return view('clues.form', compact('cases', 'scenarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'case_id' => 'required',
            'scenario_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        Clue::create($request->only(
            'case_id',
            'scenario_id',
            'name',
            'description'
        ));

        return redirect()->route('clues.index');
    }

    public function edit($id): View
    {
        $clue = Clue::findOrFail($id);
        $cases = GameCase::all();
        $scenarios = Scenario::all();


        return view('clues.form', compact('clue', 'cases', 'scenarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'case_id' => 'required',
            'scenario_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        $clue = Clue::findOrFail($id);

        $clue->update($request->only(
            'case_id',
            'scenario_id',
            'name',
            'description'
        ));

        return redirect()->route('clues.index');
    }

    public function destroy(Request $request)
    {
        $clue = Clue::findOrFail($request->id);

        $clue->delete();

        return redirect()->route('clues.index');
    }
}