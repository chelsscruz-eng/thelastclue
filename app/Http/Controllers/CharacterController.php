<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\GameCase;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index(): View
    {
        $characters = Character::all();
        return view('characteres.index', compact('characters'));
    }

    public function create()
    {
        $cases = GameCase::all();
        
        return view('characteres.form', compact('cases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'case_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'role' => 'required'
        ]);

        Character::create($request->only(
            'case_id',
            'name',
            'description',
            'role'
        ));

        return redirect()->route('characters.index');
    }

    public function edit($id): View
    {
        $character = Character::findOrFail($id);

        return view('characteres.form', compact('character'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'case_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'role' => 'required'
        ]);

        $character = Character::findOrFail($id);

        $character->update($request->only(
            'case_id',
            'name',
            'description',
            'role'
        ));

        return redirect()->route('characters.index');
    }

    public function destroy(Request $request)
    {
        $character = Character::findOrFail($request->id);

        $character->delete();

        return redirect()->route('characters.index');
    }
}