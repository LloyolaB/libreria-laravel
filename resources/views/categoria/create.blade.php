@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{url('/categorias')}}" method="post" enctype="multipart/form-data">
@csrf
@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
    </ul>
</div> 
@endif
<h1>Crear Categoria</h1>
@include('categoria.form')
</form>
</div>
@endsection