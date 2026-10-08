<?php

namespace App\Http\Controllers;

use App\Models\GameCase;
use App\Models\Scenario;
use Illuminate\View\View;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(): View
    {
        $cases = GameCase::withCount('scenarios')->get();

        return view('game.index', compact('cases'));
    }

    public function play($id)
    {
        $case = GameCase::findOrFail($id);

        $scenario = Scenario::where('case_id', $id)
            ->orderBy('id')
            ->first();

        return view('scenarios.museum.intro', compact('case', 'scenario'));
    }

    public function scenarios($id)
    {
        $case = GameCase::findOrFail($id);
        $scenarios = Scenario::where('case_id', $id)
            ->orderBy('id')
            ->get();

        return view('scenarios.museum.scenes', compact('case', 'scenarios'));
    }

    public function scenario($case, $scenario)
    {
        $case = GameCase::findOrFail($case);
        $scenarios = Scenario::where('case_id', $case->id)
            ->orderBy('id')
            ->get();

        $scenario = Scenario::findOrFail($scenario);
        $scenarioNumber = $scenarios->search(function ($item) use ($scenario) {
            return $item->id == $scenario->id;
        }) + 1;

        return view('scenarios.museum.scenario' . $scenarioNumber, compact('case', 'scenario'));
    }
    
    public function completeScenario($case, $scenario)
    {
       session()->put('completed_scenarios.' . $scenario, true);

        $scenarios = Scenario::where('case_id', $case)
            ->orderBy('id')
            ->get();

        $scenarioNumber = $scenarios->search(function ($item) use ($scenario) {
            return $item->id == $scenario;
        }) + 1;

        if ($scenarioNumber == 2) {
            session()->forget('inventory.' . $case . '.letter');
        }

        if ($scenarioNumber == 3) {
            return view('scenarios.museum.complete', compact('case'));
        }

        return redirect()->route('game.scenarios', $case);
    }

    public function addInventory(Request $request)
    {
        $inventory = session('inventory', []);
        $inventory[$request->case_id][$request->item] = true;
        session()->put('inventory', $inventory);

        return response()->json([
            'status' => true
        ]);
    }
}