@extends('layouts.admin')

@section('content')

    <div class="row mb-4">
        <div class="col-sm-12">
            <h2 class="titulo-pagina">Casos</h2>
        </div>
    </div>
    <div class="card card-admin">
        <div class="card-body p-0">
            @if($cases->count() > 0)
                <table class="table table-hover table-admin mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cases as $case)
                            <tr>
                                <td>{{ $case->id }}</td>
                                <td>{{ $case->title }}</td>
                                <td style="max-width:300px;">
                                    {{ strlen($case->description) > 150 ? substr($case->description, 0, 150) . '...' : $case->description }}
                                </td>
                                <td>
                                    <a href="{{ route('cases.edit',$case->id) }}"class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('cases.delete') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $case->id }}">
                                        <a href="#fmborrar" class="btn btn-sm btn-danger delete-case" data-id="{{ $case->id }}" data-message="{{ $case->title }}">Eliminar</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="fmborrar" class="modal-borrar modal-block modal-block-primary mfp-hide">
                    <section class="card"> 
                        <header class="card-header">
                            <h2 class="card-title">¿Eliminar Caso?</h2>
                        </header>
                        <div class="card-body">
                            <div class="modal-wrapper">
                                <div class="modal-icon"><i class="fas fa-question-circle"></i></div>
                                <div class="modal-text">
                                    <p>¿ Seguro que quieres eliminar el caso<b>"<span id="fmborrar-content"></span>"</b>?</p>
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
                <div class="p-4 text-center">Aún no se han creado casos.</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="text-end mt-4">
            <a href="{{ route('cases.create') }}" class="btn boton-admin">Agregar Caso</a>
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
                $.post("/cases/delete", {
                    id:id,
                    _token:$('meta[name="csrf-token"]').attr('content')
                }, function(){
                    window.location.href='/cases';
                });
            });
        });

    </script>

@endsection