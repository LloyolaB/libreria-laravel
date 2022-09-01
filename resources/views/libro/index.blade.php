@extends('layouts.app')

@section('content')
<div class="container">
{{-- creamos mensajes de confirmacion sobre la operacion realizada --}}
@if(Session::has('mensaje'))
    <div class="alert alert-success">{{ Session::get('mensaje') }}</div>
@endif
<div class="container">
    <div class="row justify-content-between">
        {{-- //boton para crear un nuevo libro --}}
        <div class="col-4">            
            <a href="{{url('/libros/create')}}" class="btn btn-success">Registrar Nuevo Libro</a>
        </div>
        {{-- //boton para generar una nueva categoria --}}
        <div class="col-2">
            <a href="{{url('/categorias/create')}}" class="btn btn-primary">Crear Nueva Categoria</a>
        </div>
    </div>
</div>

<div class="text-center"><h1>Libreria</h1></div>

<div class="table-responsive shadow p-3 mb-5 bg-white rounded">
    <table class="table table-light">
        {{-- encabezado de la tabla --}}
        <thead>
            <tr>
                <th >#</th>
                <th >Foto</th>
                <th >Titulo</th>
                <th >Autor</th>
                <th >Editorial</th>
                <th >Categoria</th>
                <th >Acciones</th>
            </tr>
        </thead>
        {{-- cuerpo de la tabla --}}
        <tbody>
            {{-- con un foreach recorremos todos los datos de la tabla libros --}}
            @foreach ($libros as $libro)
            <tr class="shadow-sm p-3 mb-5 bg-white rounded">
                <td>{{$libro->id}}</td>
                <td>
                    <img class= "img-thumbnail img-fluid" src="{{asset('storage').'/'.$libro->foto}}" width=100 alt="{{$libro->titulo}}">
                </td>
                <td>{{$libro->titulo}}</td>
                <td>{{$libro->autor}}</td>
                <td>{{$libro->editorial}}</td>
                <td>{{$libro->categorias->nombre}}</td>
                <td>
                    {{-- boton para editar un libro --}}
                    <a href="{{url('/libros/'.$libro->id.'/edit')}}" class="btn btn-warning">Editar</a>
                    {{-- boton para eliminar un libro --}}
                    <form action="{{url('/libros/'.$libro->id)}}" onclick="return confirm("quieres borrar?")" class="d-inline" method="post">
                        @csrf
                        {{method_field('DELETE')}}
                        <input type="submit" class="btn btn-danger" value="Borrar">
                    </form></tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection