<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\jsonResponse; //para api
use App\Http\Resources\ProductoResource;
use App\Models\Producto;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::orderBy('id','desc') -> paginate(10);

        return response()->json([
            'status'  => 'success',
            'data'    => ProductoResource::collection($productos),
            'paginacion' => [
                'total' => $productos->total(),
                'per_page' => $productos->perPage(),
                'current_page' => $productos->currentPage(),
                'last_page' => $productos->lastPage(),
            ]
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validados = $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|string',
            'stock' => 'required|string',
        ]);
        $producto = Producto::create($validados);
        return response()->json([
            'status'  => 'created',
            'message'  => 'Articulo ingresado exitosamente',
            'data'  => new ProductoResource($producto),
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) 
    {
        $producto = Producto::find($id);
        if(!$producto){
            return response()->json([
                'status'=>'error',
                'message'=>'el producto no se encuentra'
            ], 404);
        }
        return response()->json([
            'status'=>'success',
            'data'=>new ProductoResource($producto) 
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)//error en update
    {
        $producto = Producto::find($id);
        if(!$producto){
            return response()->json([
                'status'=>'error',
                'message'=>'el producto no se encuentra'
            ], 404);
        }
        
        $validados = $request->validate([
            'nombre'      => "required|string",
            'precio'      => "required|numeric",
            'stock'      => "required|integer"
        ]);

        $producto->update($validados);
        return response()->json([
            'status'=>'updated',
            'message'=>'producto actualizado correctamente',
            'data'=>new ProductoResource($producto) 
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);
        if(!$producto){
            return response()->json([
                'status'=>'error',
                'message'=>'el producto no se encuentra'
            ], 404);
        }

        $producto->delete();
        return response()->json([
            'status'=>'deleted',
            'message'=>'producto eliminado correctamente'
        ],200);
    }
}
