<?php

namespace App\Http\Controllers;

use App\Models\Dialogue;
use App\Models\Character;
use App\Models\Clue;
use Illuminate\View\View;
use Illuminate\Http\Request;

class DialogueController extends Controller
{
    public function index(): View
    {
        $dialogues = Dialogue::all();
        return view('dialogues.index', compact('dialogues'));
    }

    public function create()
    {
        $characters = Character::all();
        $clues = Clue::all();
    
        return view('dialogues.form', compact('characters', 'clues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'character_id' => 'required',
            'question' => 'required|max:255',
            'answer' => 'required',
            'clue_id' => 'nullable'
        ]);

        Dialogue::create($request->only(
            'character_id',
            'question',
            'answer',
            'clue_id'
        ));

        return redirect()->route('dialogues.index');
    }

    public function edit($id): View
    {
        $dialogue = Dialogue::findOrFail($id);
        $characters = Character::all();
        $clues = Clue::all();

        return view('dialogues.form', compact('dialogue', 'characters', 'clues'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'character_id' => 'required',
            'question' => 'required|max:255',
            'answer' => 'required',
            'clue_id' => 'nullable'
        ]);

        $dialogue = Dialogue::findOrFail($id);

        $dialogue->update($request->only(
            'character_id',
            'question',
            'answer',
            'clue_id'
        ));

        return redirect()->route('dialogues.index');
    }

    public function destroy(Request $request)
    {
        $dialogue = Dialogue::findOrFail($request->id);
        $dialogue->delete();

        return redirect()->route('dialogues.index');
    }
}