@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('mensaje'))
            <div class="alert alert-success">{{ Session::get('mensaje') }}</div>
        @endif
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4">
                    <a href="{{ url('/libros/create') }}" class="btn btn-success">Registrar Nuevo Libro</a>
                </div>
                <div class="col-2">
                    <a href="{{ url('/categorias/create') }}" class="btn btn-primary">Crear Nueva Categoria</a>
                </div>
            </div>

        </div>
        <div class="text-center">
            <h1>Categorías</h1>
        </div>


        <div class="table-responsive shadow p-3 mb-5 bg-white rounded row justify-content-md-center">
            <table class="table table-light ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr class="shadow-sm p-3 mb-5 bg-white rounded">
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td>
                                <a href="{{ url('/categorias/' . $categoria->id . '/edit') }}"
                                    class="btn btn-warning">Editar</a>
                                <form action="{{ url('/categorias/' . $categoria->id) }}" onclick="return confirm("quieres
                                    borrar?")" class="d-inline" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-danger" value="Borrar">
                                </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection



</div>
