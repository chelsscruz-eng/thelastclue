@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h1 class="titulo-pagina">
        @if(isset($clue))
            Editar Pista
        @else
            Nueva Pista
        @endif
    </h1>
    @if(isset($clue))
        <form action="{{ route('clues.update', $clue->id) }}" method="POST">
    @else
        <form action="{{ route('clues.store') }}" method="POST">
    @endif
        @csrf
        <div class="row mt-5">
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Caso</label>
            <div class="col-sm-4">
                <select name="case_id" class="form-control" required>
                    @foreach($cases as $case)
                        <option value="{{ $case->id }}" {{ old('case_id', $clue->case_id ?? '') == $case->id ? 'selected' : '' }}>
                            {{ $case->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Escenario</label>
            <div class="col-sm-4">
                <select name="scenario_id" class="form-control" required>
                    @foreach($scenarios as $scenario)
                        <option value="{{ $scenario->id }}" {{ old('scenario_id', $clue->scenario_id ?? '') == $case->id ? 'selected' : '' }}>
                            {{ $scenario->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Nombre</label>
            <div class="col-sm-4">
                <input type="text" name="name" class="form-control" value="{{ old('name', $clue->name ?? '') }}" required>
            </div>        
        </div>
        <div class="row mt-3">
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Descripción</label>
            <div class="col-sm-4">
                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $clue->description ?? '') }}</textarea>
            </div>        
        </div>
        <footer>
            <div class="row justify-content-end">
                <div class="col-sm-8 mt-4">
                    <button type="submit" class="btn boton-admin">Guardar</button>
                    <a href="{{ route('clues.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </footer>
    </form>
</div>

@endsection