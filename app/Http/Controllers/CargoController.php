<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    // Listar todos los cargos
    public function index()
    {
        $cargos = Cargo::orderBy('nombre_cargo')->get();
        return view('cargos.index', compact('cargos'));
    }

    // Formulario para crear cargo
    public function create()
    {
        return view('cargos.create');
    }

    // Guardar nuevo cargo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_cargo' => 'required|string|max:100|unique:cargos,nombre_cargo',
        ]);

        Cargo::create([
            'nombre_cargo' => $validated['nombre_cargo'],
        ]);

        return redirect()->route('cargos.index')->with('success', 'Cargo registrado correctamente.');
    }

    // Formulario para editar cargo
    public function edit(Cargo $cargo)
    {
        return view('cargos.edit', compact('cargo'));
    }

    // Actualizar cargo
    public function update(Request $request, Cargo $cargo)
    {
        $validated = $request->validate([
            'nombre_cargo' => 'required|string|max:100|unique:cargos,nombre_cargo,' . $cargo->id,
        ]);

        $cargo->update([
            'nombre_cargo' => $validated['nombre_cargo'],
        ]);

        return redirect()->route('cargos.index')->with('success', 'Cargo actualizado correctamente.');
    }

    // Eliminar cargo
    public function destroy(Cargo $cargo)
    {
        $cargo->delete();
        return redirect()->route('cargos.index')->with('success', 'Cargo eliminado correctamente.');
    }
}