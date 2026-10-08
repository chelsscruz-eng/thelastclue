@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h1 class="titulo-pagina">
        @if(isset($dialogue))
            Editar Pista
        @else
            Nueva Pista
        @endif
    </h1>
    @if(isset($dialogue))
        <form action="{{ route('dialogues.update', $dialogue->id) }}" method="POST">
    @else
        <form action="{{ route('dialogues.store') }}" method="POST">
    @endif
        @csrf
        <div class="row mt-5">
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Personaje :</label>
            <div class="col-sm-2">
                <select name="character_id" class="form-control" required>
                    @foreach($characters as $character)
                        <option value="{{ $character->id }}" {{ old('character_id', $dialogue->character_id ?? '') == $character->id ? 'selected' : '' }}>
                            {{ $character->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Pregunta :</label>
            <div class="col-sm-4">
                <input type="text" name="question" class="form-control" value="{{ old('question', $dialogue->question ?? '') }}" required>
            </div>
        </div>
        <div class="row mt-3">
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Respuesta :</label>
            <div class="col-sm-4">
              <input type="text" name="answer" class="form-control" value="{{ old('answer', $dialogue->answer ?? '') }}" required>
            </div>        
        </div>
        <div class="row mt-3">
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Pista :</label>
            <div class="col-sm-2">
                <select name="clue_id" class="form-control">
                    <option value="">Sin pista</option>
                    @foreach($clues as $clue)
                        <option value="{{ $clue->id }}" {{ old('clue_id', $dialogue->clue_id ?? '') == $clue->id ? 'selected' : '' }}>
                            {{ $clue->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
       <footer>
            <div class="row justify-content-end">
                <div class="col-sm-8 mt-4">
                    <button type="submit" class="btn boton-admin">Guardar</button>
                    <a href="{{ route('dialogues.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </footer>
    </form>
</div>

@endsection