<?php

namespace App\Http\Controllers;

use App\Models\Scenario;
use App\Models\GameCase;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ScenarioController extends Controller
{
    public function index(): View
    {
        $cases = GameCase::withCount('scenarios')->get();
        return view('scenarios.index', compact('cases'));
    }

    public function create()
    {
        $cases = GameCase::all();
    
        return view('scenarios.form', compact('cases'));
    }

    public function store(Request $request)
    {   
        $request->validate([
            'case_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        if (!GameCase::find($request->case_id)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'El caso seleccionado no existe.');
        }

        foreach ($request->name as $i => $name) {

            Scenario::create([
                'case_id' => $request->case_id,
                'name' => $name,
                'description' => $request->description[$i],
            ]);
        }

        return redirect()->route('scenarios.index');
    }

    public function edit($id): View
    {
        $cases = GameCase::all();
        $selectedCase = GameCase::findOrFail($id);
        $scenarios = Scenario::where('case_id', $selectedCase->id)->get();

        return view('scenarios.form', compact(
            'cases',
            'selectedCase',
            'scenarios'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'case_id' => 'required',    
            'name' => 'nullable|array',
            'description' => 'nullable|array'
        ]);

        $selectedCase = GameCase::findOrFail($id);
        Scenario::where('case_id', $selectedCase->id)->delete();

        foreach ($request->name ?? [] as $i => $name) {

            Scenario::create([
                'case_id' => $selectedCase->id,
                'name' => $name,
                'description' => $request->description[$i],
            ]);
        }

        return redirect()->route('scenarios.index');
    }

    public function destroy(Request $request)
    {
        $scenario = Scenario::findOrFail($request->id);

        $scenario->delete();

        return redirect()->route('scenarios.index');
    }
}