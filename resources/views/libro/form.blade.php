
<h1>{{$modo}} Libro</h1>
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
<label for="titulo">Ingresa Titulo</label>
<input type="text" class='form-control' name="titulo" value ="{{isset($libros->titulo)?$libros->titulo:old('titulo')}}" id="">

</div>
<div class="form-group">
<label for="autor">Ingresa Autor</label>
<input type="text" class='form-control'  name="autor" value= "{{isset($libros->autor)?$libros->autor:old('autor')}}" id="">

</div>
<div class="form-group">
<label for="editorial">Ingresa Editorial</label>
<input type="text" class='form-control' name="editorial" value= "{{isset($libros->editorial)?$libros->editorial:old('editorial')}}" id=""></div>
<div class="form-group">
<label for="categoria">Ingresa categoria</label>
{{-- <input type="text" class='form-control' name="categoria_id" value = "{{isset($libros->categoria_id)?$libros->categoria_id:old('categoria_id')}}" id=""> --}}
<select name="categoria_id" id="" class="form-control">
    <option disabled selected>Selecciona una opción</option>
    @foreach ($categorias as $categoria) 
    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
    @endforeach
</select>
</div>
<div class="form-group">
<label for="foto"></label>
@if(@isset($libros->foto))
<img src="{{asset('storage').'/'.$libros->foto}}" class="img-thumbnail img-fluid" width = 150px alt="{{$libros->titulo}}">   
@endif
<input type="file" class='form-control' name="foto" value= "{{isset($libros->foto)?$libros->foto:''}}" id="">

</div> 
<input type="submit" class="btn btn-lg btn-success mt-3"value="{{$modo}} Libro">

<a href="{{url('/libros/')}}" class= "btn btn-lg btn-primary mt-3">Regresar</a>