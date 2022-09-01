@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('mensaje'))
            <div class="alert alert-success">{{ Session::get('mensaje') }}</div>
        @endif
        <form action="{{ url('/libros/' . $libros->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}
            @include('libro.form', ['modo' => 'Editar'])

        </form>
    </div>
@endsection
