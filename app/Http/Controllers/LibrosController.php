<?php

namespace App\Http\Controllers;

use App\Models\Libros;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['libros'] = Libros::all();
        return view('libro/index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = Categorias::all();
        $libros = Libros::paginate(5);

        return view('libro/create', compact('categorias', 'libros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //seteamos los campos que vamos a validar
        $campos = [
            'titulo' => 'required|string|max:100',
            'autor' => 'required|string|max:100',
            'editorial' => 'required|string|max:100',
            'categoria_id' => 'required|string|max:100',
            'foto' => 'required|max:10000|mimes:jpeg,png,jpg',
        ];
        //personalizamos los mensajes de error
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'foto.required' => 'La foto es requerida',
        ];
        //validamos los campos del formulario
        $this->validate($request, $campos, $mensaje);
        //de la request quitamos el token
        $datosDeLibro = request()->except('_token');
        //validamos que exista un archivo
        if ($request->hasFile('foto')) {
            $datosDeLibro['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        //Insertamos los datos en la BD
        Libros::insert($datosDeLibro);
        //redireccionamos a la vista index con un mensaje
        return redirect('libros')->with('mensaje', 'Libro agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Libros  $libros
     * @return \Illuminate\Http\Response
     */
    public function show(Libros $libros)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Libros  $libros
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //buscamos el libro por el id
        $libros = Libros::findOrFail($id);
        //buscamos las categorias
        $categorias = Categorias::all();

        //retornamos la vista con los datos        
        return view('libro.edit', compact('libros', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Libros  $libros
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //seteamos los campos que vamos a validar
        $campos = [
            'titulo' => 'required|string|max:100',
            'autor' => 'required|string|max:100',
            'editorial' => 'required|string|max:100',
            'categoria_id' => 'required|string|max:100',
        ];
        //personalizamos los mensajes de error
        $mensaje = [
            'required' => 'El :attribute es requerido',
        ];
        // con el if validamos que el campo foto no sea requerido ya que puede dejar el mismo que tenia
        if ($request->hasFile('foto')) {
            $campos = ['foto' => 'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje = ['foto.required' => 'La foto es requerida',];
        }
        //validamos los campos del formulario
        $this->validate($request, $campos, $mensaje);
        //filtramos los datos que no queremos (token y el method)        
        $datosDeLibro = request()->except(['_token', '_method']);
        //verificamos si existe la foto
        if ($request->hasFile('foto')) {
            //obtenemos el libro
            $libros = Libros::findOrFail($id);
            //eliminamos la foto del storage
            Storage::delete('public/' . $libros->foto);
            //guardamos la nueva foto
            $datosDeLibro['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        // verificamos si el id existe
        Libros::where('id', '=', $id)->update($datosDeLibro);
        //Volvemos a buscar por el id
        $libros = Libros::findOrFail($id);
        //redireccionamos a la vista index con un mensaje
        $categorias = Categorias::all();
        //retornamos la vista con los nuevos datos
        return redirect('libros')->with('mensaje', 'Libro modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Libros  $libros
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //buscar la imagen del libro
        $libro = Libros::findOrFail($id);
        //verificamos si existe la foto del libro
        if (Storage::delete('public/' . $libro->foto)) {
            // en caso de borrar la foto, eliminamos el registro del libro
            Libros::destroy($id);
        }
        //redireccionamos a la vista index
        return redirect('libros')->with('mensaje', 'Libro eliminado con éxito');
    }
}
