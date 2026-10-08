<?php

namespace App\Http\Controllers;

use App\Models\GameCase;
use Illuminate\View\View;
use Illuminate\Http\Request;

class GameCaseController extends Controller
{
    public function index(): View 
    {
        $cases = GameCase::all();
        return view('cases.index', compact('cases'));
    }

    public function create()
    {
        return view('cases.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        GameCase::create($request->only('title', 'description'));

        return redirect()->route('cases.index');
    }

    public function edit($id): View
    {
        $case = GameCase::findOrFail($id);

         return view('cases.form', [
        'case' => $case,
        'readonly' => false
    ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        $case = GameCase::findOrFail($id);

        $case->update($request->only('title', 'description'));

        return redirect()->route('cases.index');
    }

    public function destroy(Request $request)
    {
        $case = GameCase::findOrFail($request->id);
        $case->delete();

        return redirect()->route('cases.index');
    }
}
