@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h1 class="titulo-pagina">
        @if(isset($case))
            Editar caso
        @else
            Nuevo caso
        @endif
    </h1>

    @if(isset($case))
        <form action="{{ route('cases.update', $case->id) }}" method="POST">
    @else
        <form action="{{ route('cases.store') }}" method="POST">
    @endif
        @csrf
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $case->title ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $case->description ?? '') }}</textarea>
        </div>
        <button type="submit" class="btn boton-admin">Guardar</button>
        <a href="{{ route('cases.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection