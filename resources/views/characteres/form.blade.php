@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h1 class="titulo-pagina">
        @if(isset($character))
            Editar Personaje
        @else
            Nuevo Personaje
        @endif
    </h1>

    @if(isset($character))
        <form action="{{ route('characters.update', $character->id) }}" method="POST">
    @else
        <form action="{{ route('characters.store') }}" method="POST">
    @endif
        @csrf
        <div class="row mt-5">
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Caso</label>
            <div class="col-sm-4">
                <select name="case_id" class="form-control" required>
                    @foreach($cases as $case)
                        <option value="{{ $case->id }}" {{ old('case_id', $character->case_id ?? '') == $case->id ? 'selected' : '' }}>
                            {{ $case->title }}
                        </option>
                    @endforeach
                </select>
            </div>        
        </div>
        <div class="row mt-3">
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Nombre</label>
            <div class="col-sm-4">
                <input type="text" name="name" class="form-control" value="{{ old('name', $character->name ?? '') }}" required>
            </div>        
        </div>
        <div class="row mt-3">
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Rol</label>
            <div class="col-sm-4">
                <input type="text" name="role" class="form-control" value="{{ old('role', $character->role ?? '') }}" required>
            </div>
        </div>
        <div class="row mt-3">  
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Descripción</label>
            <div class="col-sm-4">
                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $character->description ?? '') }}</textarea>
            </div>        
        </div>
        <footer>
            <div class="row justify-content-end">
                <div class="col-sm-8 mt-4">
                    <button type="submit" class="btn boton-admin">Guardar</button>
                    <a href="{{ route('characters.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </footer>
    </form>
</div>

@endsection