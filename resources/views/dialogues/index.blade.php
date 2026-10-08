@extends('layouts.admin')


@section('content')

    <div class="row mb-4">
        <div class="col-sm-12">
            <h2 class="titulo-pagina">Diálogos</h2>
        </div>
    </div>
    <div class="card card-admin">
        <div class="card-body p-0">
            @if($dialogues->count() > 0)
                <table class="table table-hover table-admin mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Personaje</th>
                            <th>Pregunta</th>
                            <th>Respuesta</th>
                            <th>Pista</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dialogues as $dialogue)
                            <tr>
                                <td>{{ $dialogue->id }}</td>
                                <td>{{ $dialogue->character_id }}</td>
                                <td>{{ $dialogue->question }}</td>
                                <td style="max-width:300px;">
                                    {{ strlen($dialogue->answer) > 150 ? substr($dialogue->answer,0,150).'...' : $dialogue->answer }}
                                </td>
                                <td>{{ $dialogue->clue ? $dialogue->clue->name : '-' }}</td>
                                <td>
                                    <a href="{{ route('dialogues.edit',$dialogue->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('dialogues.delete') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $dialogue->id }}">
                                        <a href="#fmborrar" class="btn btn-sm btn-danger delete-dialogue" data-id="{{ $dialogue->id }}" data-message="{{ $dialogue->name }}">
                                            Eliminar
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="fmborrar" class="modal-borrar modal-block modal-block-primary mfp-hide">
                    <section class="card"> 
                        <header class="card-header">
                            <h2 class="card-title">¿Eliminar Diálogo?</h2>
                        </header>
                        <div class="card-body">
                            <div class="modal-wrapper">
                                <div class="modal-icon"><i class="fas fa-question-circle"></i></div>
                                <div class="modal-text">
                                    <p>¿ Seguro que quieres eliminar el Diálogo<b>"<span id="fmborrar-content"></span>"</b>?</p>
                                </div>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <button id="borrar-confirm" class="btn boton-admin">Confirmar</button>
                                    <button id="borrar-dismiss" class="btn btn-default">Cancelar</button>
                                </div>
                            </div>
                        </footer>
                    </section>
                </div>
            @else
                <div class="p-4 text-center">
                    Aún no se han creado Diálogos.
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="text-end mt-4">
            <a href="{{ route('dialogues.create') }}" class="btn boton-admin">Agregar Diálogo</a>
        </div>
    </div>

@endsection

@section('postscripts')

    <script>

        $(document).ready(function(){

            var id = 0;
            var message = '';

            $('.delete-dialogue').click(function(){
                id = $(this).data('id');
                message = $(this).data('message');
                $('#fmborrar-content').html(message);
            });

            $('.delete-dialogue').magnificPopup({
                type:'inline',
                preloader:false,
                modal:true
            });

            $('#borrar-dismiss').click(function(e){
                e.preventDefault();
                $.magnificPopup.close();
            });

            $('#borrar-confirm').click(function(e){
                e.preventDefault();
                $.magnificPopup.close();
                $.post("/dialogues/delete", {
                    id:id,
                    _token:$('meta[name="csrf-token"]').attr('content')
                }, function(){
                    window.location.href='/dialogues';
                });
            });
        });

    </script>

@endsection