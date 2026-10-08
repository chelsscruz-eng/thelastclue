@extends('layouts.admin')

@section('content')

    <div class="row mb-4">
        <div class="col-sm-12">
            <h2 class="titulo-pagina">Escenarios</h2>
        </div>
    </div>
    <div class="card card-admin">
        <div class="card-body p-0">
            @if($cases->count() > 0)
                <table class="table table-hover table-admin mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Caso</th>
                            <th>Escenarios</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cases as $case)
                            <tr>
                                <td>{{ $case->id }}</td>
                                <td>{{ $case->title }}</td>
                                <td>{{ $case->scenarios_count }}</td>
                                <td>
                                    <a href="{{ route('scenarios.edit',$case->id) }}"
                                    class="btn btn-warning btn-sm">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="fmborrar" class="modal-borrar modal-block modal-block-primary mfp-hide">
                    <section class="card"> 
                        <header class="card-header">
                            <h2 class="card-title">¿Eliminar Escenario?</h2>
                        </header>
                        <div class="card-body">
                            <div class="modal-wrapper">
                                <div class="modal-icon"><i class="fas fa-question-circle"></i></div>
                                <div class="modal-text">
                                    <p>¿ Seguro que quieres eliminar el Escenario<b>"<span id="fmborrar-content"></span>"</b>?</p>
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
                <div class="p-4 text-center">Aún no se han creado Escenarios.</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="text-end mt-4">
            <a href="{{ route('scenarios.create') }}" class="btn boton-admin">Agregar Escenario</a>
        </div>
    </div>

@endsection

@section('postscripts')

    <script>
        
        $(document).ready(function(){

            var id = 0;
            var message = '';
            $('.delete-case').click(function(){
                id = $(this).data('id');
                message = $(this).data('message');
                $('#fmborrar-content').html(message);
            });

            $('.delete-case').magnificPopup({
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
                $.post("/scenarios/delete", {
                    id:id,
                    _token:$('meta[name="csrf-token"]').attr('content')
                }, function(){
                    window.location.href='/scenarios';
                });
            });
        });

    </script>

@endsection