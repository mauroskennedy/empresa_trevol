<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\User;
use App\Models\Cargo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    // Lista todos los empleados
    public function index()
    {
        $empleados = Empleado::with(['user', 'cargo'])->orderBy('id')->get();
        return view('empleados.index', compact('empleados'));
    }

    // Formulario para crear empleado
    public function create()
    {
        $cargos = Cargo::orderBy('nombre_cargo')->get();
        return view('empleados.create', compact('cargos'));
    }

    // Guardar nuevo empleado
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido_pat' => 'required|string|max:100',
            'apellido_mat' => 'required|string|max:100',
            'ci' => 'required|string|max:20|unique:users,ci',
            'email' => 'required|string|max:50|unique:users,email',
            'cel' => 'nullable|string|max:8',
            'cargo_id' => 'required|exists:cargos,id',
            'foto' => 'nullable|image|max:2048',
            'cedula_identidad' => 'nullable|file|mimes:pdf|max:2048',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
            'memorandum' => 'nullable|file|mimes:pdf|max:2048',
            'certificado_medico' => 'nullable|file|mimes:pdf|max:2048',
            'boleta_pago' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Crear usuario automáticamente
        $user = User::create([
            'nombre' => $validated['nombre'],
            'apellido_pat' => $validated['apellido_pat'],
            'apellido_mat' => $validated['apellido_mat'],
            'ci' => $validated['ci'],
            'cel' => $validated['cel']?? null,
            'email' => $validated['email'],
            'password' => null, 
            'foto' => $request->hasFile('foto') 
                ? $request->file('foto')->store('fotos/empleados', 'public') 
                : 'avatar.png',
        ]);

        // Guardar empleado
        $empleado = new Empleado();
        $empleado->user_id = $user->id;
        $empleado->cargo_id = $validated['cargo_id'];

        // Guardar documentos opcionales
        foreach (['cedula_identidad','cv','memorandum','certificado_medico','boleta_pago'] as $doc) {
            $empleado->$doc = $request->hasFile($doc) 
                ? $request->file($doc)->store('documentos/empleados', 'public') 
                : null;
        }

        $empleado->save();

        return redirect()->route('empleados.index')->with('success', 'Empleado registrado correctamente.');
    }

    // Formulario para editar empleado
    public function edit(Empleado $empleado)
    {
        $cargos = Cargo::orderBy('nombre_cargo')->get();
        return view('empleados.edit', compact('empleado', 'cargos'));
    }

    // Actualizar empleado
    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido_pat' => 'required|string|max:100',
            'apellido_mat' => 'required|string|max:100',
            'ci' => 'required|string|max:20|unique:users,ci,' . $empleado->user_id,
            'email' => 'required|string|max:50|unique:users,email,' . $empleado->user_id,
            'cel' => 'nullable|string|max:8',
            'cargo_id' => 'required|exists:cargos,id',
            'foto' => 'nullable|image|max:2048',
            'cedula_identidad' => 'nullable|file|mimes:pdf|max:2048',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
            'memorandum' => 'nullable|file|mimes:pdf|max:2048',
            'certificado_medico' => 'nullable|file|mimes:pdf|max:2048',
            'boleta_pago' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $user = $empleado->user;

        // Actualizar usuario
        $user->update([
            'nombre' => $validated['nombre'],
            'apellido_pat' => $validated['apellido_pat'],
            'apellido_mat' => $validated['apellido_mat'],
            'ci' => $validated['ci'],
            'email' => $validated['email'],
            'cel' => $validated['cel']?? null,
            'password' => null,
            'foto' => $request->hasFile('foto')
                ? $request->file('foto')->store('fotos/empleados', 'public')
                : $user->foto ?? 'avatar.png',
        ]);

        // Actualizar empleado
        $empleado->cargo_id = $validated['cargo_id'];

        foreach (['cedula_identidad','cv','memorandum','certificado_medico','boleta_pago'] as $doc) {
            if ($request->hasFile($doc)) {
                // Eliminar archivo anterior si existe
                if ($empleado->$doc) {
                    Storage::disk('public')->delete($empleado->$doc);
                }
                $empleado->$doc = $request->file($doc)->store('documentos/empleados', 'public');
            }
        }

        $empleado->save();

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
    }

    // Eliminar empleado
    public function destroy(Empleado $empleado)
    {
        $user = $empleado->user;

        // Eliminar documentos
        foreach (['cedula_identidad','cv','memorandum','certificado_medico','boleta_pago'] as $doc) {
            if ($empleado->$doc) {
                Storage::disk('public')->delete($empleado->$doc);
            }
        }

        // Eliminar foto del usuario
        if ($user->foto && $user->foto !== 'avatar.png') {
            Storage::disk('public')->delete($user->foto);
        }

        $empleado->delete();
        $user->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
    }
}
