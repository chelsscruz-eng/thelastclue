<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameCaseController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ScenarioController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ClueController;
use App\Http\Controllers\DialogueController;

// Route::get('/', function () {
//     return view('welcome');
// });

    // Juego
Route::get('/', [GameController::class, 'index'])->name('game.index');
Route::get('/play/{id}', [GameController::class, 'play'])->name('game.play');
Route::get('/play/{id}/scenarios', [GameController::class, 'scenarios'])->name('game.scenarios');
Route::get('/play/{case}/scenario/{scenario}', [GameController::class, 'scenario'])->name('game.scenario');

    // Cases
Route::get('/cases', [GameCaseController::class, 'index'])->name('cases.index');
Route::get('/cases/create', [GameCaseController::class, 'create'])->name('cases.create');
Route::post('/cases/store', [GameCaseController::class, 'store'])->name('cases.store');
Route::get('/cases/{id}/edit', [GameCaseController::class, 'edit'])->name('cases.edit');
Route::post('/cases/delete', [GameCaseController::class, 'destroy'])->name('cases.delete');
Route::post('/cases/update/{id}', [GameCaseController::class, 'update'])->name('cases.update');

    // Scenarios
Route::get('/scenarios', [ScenarioController::class, 'index'])->name('scenarios.index');
Route::get('/scenarios/create', [ScenarioController::class, 'create'])->name('scenarios.create');
Route::post('/scenarios/store', [ScenarioController::class, 'store'])->name('scenarios.store');
Route::get('/scenarios/{id}/edit', [ScenarioController::class, 'edit'])->name('scenarios.edit');
Route::post('/scenarios/delete', [ScenarioController::class, 'destroy'])->name('scenarios.delete');
Route::post('/scenarios/update/{id}', [ScenarioController::class, 'update'])->name('scenarios.update');
Route::post('/play/{case}/scenario/{scenario}/complete', [GameController::class, 'completeScenario'])->name('game.scenario.complete');

    // Characters
Route::get('/characters', [CharacterController::class, 'index'])->name('characters.index');
Route::get('/characters/create', [CharacterController::class, 'create'])->name('characters.create');
Route::post('/characters/store', [CharacterController::class, 'store'])->name('characters.store');
Route::get('/characters/{id}/edit', [CharacterController::class, 'edit'])->name('characters.edit');
Route::post('/characters/delete', [CharacterController::class, 'destroy'])->name('characters.delete');
Route::post('/characters/update/{id}', [CharacterController::class, 'update'])->name('characters.update');

    // Clues 
Route::get('/clues', [ClueController::class, 'index'])->name('clues.index');
Route::get('/clues/create', [ClueController::class, 'create'])->name('clues.create');
Route::post('/clues/store', [ClueController::class, 'store'])->name('clues.store');
Route::get('/clues/{id}/edit', [ClueController::class, 'edit'])->name('clues.edit');
Route::post('/clues/delete', [ClueController::class, 'destroy'])->name('clues.delete');
Route::post('/clues/update/{id}', [ClueController::class, 'update'])->name('clues.update');

    // Dialogues 
Route::get('/dialogues', [DialogueController::class, 'index'])->name('dialogues.index');
Route::get('/dialogues/create', [DialogueController::class, 'create'])->name('dialogues.create');
Route::post('/dialogues/store', [DialogueController::class, 'store'])->name('dialogues.store');
Route::get('/dialogues/{id}/edit', [DialogueController::class, 'edit'])->name('dialogues.edit');
Route::post('/dialogues/delete', [DialogueController::class, 'destroy'])->name('dialogues.delete');
Route::post('/dialogues/update/{id}', [DialogueController::class, 'update'])->name('dialogues.update');

   // Inventario
Route::post('/inventory/add', [GameController::class, 'addInventory'])->name('game.inventory.add');