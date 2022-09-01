@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{url('/categorias/'.$categoria->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}
    <h1>Editar Categoria</h1>
    @include('categoria.form')

</form>
</div>
@endsection