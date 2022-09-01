@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{url('/libros')}}" method="post" enctype="multipart/form-data">
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
@include('libro.form',['modo'=>'Crear'])
</form>
</div>
@endsection