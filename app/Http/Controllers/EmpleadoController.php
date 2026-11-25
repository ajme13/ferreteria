<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::latest()->paginate(10);
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'identidad' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'apellido' => 'nullable|string|max:255',
        'cargo' => 'required|string|max:255',
        'salario' => 'required|numeric|min:0',
        'codigo' => 'nullable|string|max:255',
        'ingreso' => 'nullable|date',
        
    ]);
    Empleado::create($request->all());
        return redirect()->route('empleados.index') ->with('success', '¡Empleado registrado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        return redirect()->route('empleados.edit', $empleado);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
        'identidad' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'apellido' => 'nullable|string|max:255',
        'cargo' => 'required|string|max:255',
        'salario' => 'required|numeric|min:0',
        'codigo' => 'nullable|string|max:255',
        'ingreso' => 'nullable|date',
    ]);
    $empleado->update($request->all());
    return redirect()->route('empleados.index')->with('success', '¡Empleado actualizado correctamente en el sistema!');
 }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', '¡Empleado eliminado del sistema!');
 }
}

