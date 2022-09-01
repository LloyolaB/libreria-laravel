@extends('layouts.app')

@section('content')
<div class="container">
{{-- creamos mensajes de confirmacion sobre la operacion realizada --}}
@if(Session::has('mensaje'))
    <div class="alert alert-success">{{ Session::get('mensaje') }}</div>
@endif
<div class="container">
    <div class="row justify-content-between">
        <div class="col-4">            
            <a href="{{url('/libros/create')}}" class="btn btn-success">Registrar Nuevo Libro</a>
        </div>
        <div class="col-4">
            <a href="{{url('/categorias/create')}}" class="btn btn-primary">Crear Nueva Categoria</a>
        </div>
    </div>

</div>

<h1 text-align="center">Librería</h1>

<div class="table-responsive shadow p-3 mb-5 bg-white rounded">
    <table class="table table-light">
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
        <tbody>
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
                    <a href="{{url('/libros/'.$libro->id.'/edit')}}" class="btn btn-warning">Editar</a>
                    <form action="{{url('/libros/'.$libro->id)}}" onclick="return confirm("quieres borrar?")" class="d-inline" method="post">
                        @csrf
                        {{method_field('DELETE')}}
                        <input type="submit" class="btn btn-danger" value="Borrar">
                    </form>            </tr>
            
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection