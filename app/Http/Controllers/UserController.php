<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
         
        $users = User::all();
        return view('usuarios.principal', compact('users'));
    }
    
        public function create()
    {
        $roles = Role::all();

        return view('usuarios.crear', ['role' => $roles]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|exists:roles,name',
        ]);

        $role = Role::where('name', $request->role)->first();

        $user = User::create([
            'nombre' => $request->input('nombre'),
            'a_paterno' => $request->input('a_paterno'),
            'a_materno' => $request->input('a_materno'),
            'num_empleado' => $request->input('num_empleado'),
            'telefono' => $request->input('telefono'),
            'cargo' => $request->input('cargo'),
            'campus' => $request->input('campus'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('usuarios.principal')
            ->with('success', 'Usuario creado exitosamente');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('usuarios.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('usuarios.editar', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update([
            'nombre' => $request->input('nombre'),
            'a_paterno' => $request->input('a_paterno'),
            'a_materno' => $request->input('a_materno'),
            'num_empleado' => $request->input('num_empleado'),
            'telefono' => $request->input('telefono'),
            'cargo' => $request->input('cargo'),
            'campus' => $request->input('campus'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('usuarios.principal')
            ->with('success', 'Usuario actualizado exitosamente');
    }
    public function disableUser($id)
    {
        $user = User::find($id);
        
        // Cambia el estado del usuario
        $user->is_active = ($user->is_active == 1) ? 0 : 1;
        
        $user->save();
    
        return redirect()->route('usuarios.principal')
            ->with('success', 'Estado del usuario actualizado correctamente');
    }
}
