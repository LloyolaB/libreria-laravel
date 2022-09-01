<div class="container">
@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
    </ul>
</div> 
@endif
<div class="form-group">
<label for="titulo">Nombre Categoria</label>
<input type="text" class='form-control' name="nombre" value ="{{isset($categoria->nombre)?$categoria->nombre:old('titulo')}}" id="">

</div>
<input type="submit" class="btn btn-lg btn-success mt-3"value="Crear Categoria">

<a href="{{url('/categorias/')}}" class= "btn btn-lg btn-primary mt-3">Regresar</a>
</div>