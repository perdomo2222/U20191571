<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Reglas\PreciosDosDecimales;
use App\Reglas\SoloLetras;
use Illuminate\Validation\ValidationException; // Corrección en esta línea
use Illuminate\Http\Request;

class ApiLibrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Libro::all();
        return response()->json($libros);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tituloLibro' => ['required', new SoloLetras],
                'autor' => ['required', new SoloLetras],
                'precio' => ['required', new PreciosDosDecimales],
                //otras reglas de validacion aqui
            ]);
            $libros = new Libro();
            $libros->fill($request->all());
            $libros->save();
            return response()->json($libros, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }
        return response()->json($libros, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $libros = Libro::find($id);
        if (!$libros) {
            return response()->json(['error' => 'Libro no encontrado'], 404);
        }
        return response()->json($libros);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $libros = Libro::findOrFail($id);
        $libros->fill($request->all());
        $libros->save();
        return response()->json($libros);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);
        $libro->delete();
        return response()->json([], 204);
    }

}