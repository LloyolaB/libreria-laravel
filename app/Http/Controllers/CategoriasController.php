<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Libros;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['categorias'] = Categorias::all();
        return view('categoria/index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categorias::all();
        $libros = Libros::paginate(5);

        return view('categoria/create', compact('categorias', 'libros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos = [
            'nombre' => 'required|string|max:150',
        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
        ];
        $this->validate($request, $campos, $mensaje);
        $datosDeLaCategoria = request()->except('_token');
        Categorias::insert($datosDeLaCategoria);
        return redirect('categorias')->with('mensaje', 'Categoria agregada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function show(Categorias $categorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categoria = Categorias::findOrFail($id);
        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //seteamos los campos que vamos a validar
        $campos = [
            'nombre' => 'required|string|max:150',
        ];
        //personalizamos los mensajes de error
        $mensaje = [
            'required' => 'El :attribute es requerido',
        ];
        //validamos los campos del formulario
        $this->validate($request, $campos, $mensaje);
        $datosDeLaCategoria = request()->except(['_token', '_method']);
        Categorias::where('id', '=', $id)->update($datosDeLaCategoria);
        return redirect('categorias')->with('mensaje', 'Categoria modificada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //buscamos la categoria por su id
        $categoria = Categorias::findOrFail($id);
        //eliminamos la categoria
        Categorias::destroy($id);
        //redireccionamos a la vista de categorias
        return redirect('categorias')->with('mensaje', 'Categoria eliminada con éxito');
    }
}
