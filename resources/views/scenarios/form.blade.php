@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h1 class="titulo-pagina">
        @if(isset($selectedCase))
            Editar Escenario
        @else
            Nuevo Escenario
        @endif
    </h1>

    @if(isset($selectedCase))
        <form action="{{ route('scenarios.update', $selectedCase->id) }}" method="POST">
    @else
        <form action="{{ route('scenarios.store') }}" method="POST">
    @endif
        @csrf
        <div class="row mt-5">
            <label class="col-sm-2 control-label text-sm-end pt-2 mt-2">Caso :</label>
            <div class="col-sm-4">
                <select name="case_id" class="form-control" required>
                    @foreach($cases as $case)
                        <option value="{{ $case->id }}" {{ old('case_id', $selectedCase->id ?? '') == $case->id ? 'selected' : '' }}>
                            {{ $case->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-10 offset-sm-2">
                <table class="table" id="scenarios_table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($scenarios))
                            @foreach($scenarios as $scenario)
                                <tr>
                                    <td>
                                        <input type="text" name="name[]" class="form-control" value="{{ $scenario->name }}" required>
                                    </td>
                                    <td>
                                        <input type="text" name="description[]" class="form-control" value="{{ $scenario->description }}" required>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger delete-row">X</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <input type="text" name="name[]" class="form-control" required>
                                </td>
                                <td>
                                    <input type="text" name="description[]" class="form-control" required>
                                </td>
                                <td></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <button id="add_scenario" class="btn boton-admin">Añadir escenario</button>
            </div>
        </div>
        <footer>
            <div class="row justify-content-end">
                <div class="col-sm-8 mt-4">
                    <button type="submit" class="btn boton-admin">Guardar</button>
                    <a href="{{ route('scenarios.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </footer>
    </form>
</div>

@endsection

@section('postscripts')

    <script>
        $(document).ready(function(){
            $("#add_scenario").click(function(){
                $("#scenarios_table tbody").append(
                    '<tr>'+
                        '<td><input type="text" name="name[]" class="form-control" required></td>'+
                        '<td><input type="text" name="description[]" class="form-control" required></td>'+
                        '<td><button class="btn btn-danger delete-row">X</button></td>'+
                    '</tr>'
                );
                return false;
            });

            $(document).on("click", ".delete-row", function(){
                $(this).closest("tr").remove();
                return false;
            });
        });

    </script>

@endsection