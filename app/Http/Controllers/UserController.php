<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Valida que sea administrador
    protected function authorizeAdmin()
    {
        if (!auth()->check() || auth()->user()->rol !== 'administrador') {
            abort(403); // Si no es admin, bloquea acceso
        }
    }

    // Lista todos los usuarios
    public function index()
    {
        $this->authorizeAdmin();

        $users = User::orderBy('apellido_pat')->get();
        return view('users.index', compact('users'));
    }

    // Formulario para crear usuario
    public function create()
    {
        $this->authorizeAdmin();
        return view('users.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido_pat' => 'required|string|max:100',
            'apellido_mat' => 'required|string|max:100',
            'ci' => 'required|string|max:20|unique:users,ci',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'cel' => 'nullable|string|max:20',
            'rol' => ['required', Rule::in(['administrador','secretaria'])],
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fotos/usuarios', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    // Formulario para editar usuario
    public function edit(User $user)
    {
        $this->authorizeAdmin();
        return view('users.edit', compact('user'));
    }

    // Actualizar usuario existente
    public function update(Request $request, User $user)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido_pat' => 'required|string|max:100',
            'apellido_mat' => 'required|string|max:100',
            'ci' => ['required','string','max:20', Rule::unique('users','ci')->ignore($user->id)],
            'email' => ['required','email', Rule::unique('users','email')->ignore($user->id)],
            'password' => 'nullable|string|min:6|confirmed',
            'cel' => 'nullable|string|max:20',
            'rol' => ['required', Rule::in(['administrador','secretaria'])],
            'foto' => 'nullable|image|max:2048',
        ]);

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }
            $validated['foto'] = $request->file('foto')->store('fotos/usuarios', 'public');
        }

        // Manejo de password opcional
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        $this->authorizeAdmin();

        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
