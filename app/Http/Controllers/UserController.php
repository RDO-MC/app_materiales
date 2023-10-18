<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Http\Controllers\Roles;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
{
     
    $users = User::all();
    return view('usuarios.principal', compact('users'));
}
// App\Http\Controllers\Auth\RegisterController

public function create()
{
    $roles = Role::all();

    return view('usuarios.crear', ['role' => $roles]);
}

public function store(Request $request)
{
    $this->validate($request, [
        // Agrega las validaciones necesarias para los campos del usuario
        'role' => 'required|exists:roles,name', // Valida que el rol exista en la tabla de roles
    ]);
    $role = Role::where('name', $request->role)->first();

// Crear usuario y asignar rol

    // Crea el nuevo usuario
    $user = User::create([
        'nombre' => $request->input('nombre'),
        'a_paterno' => $request->input('a_paterno'),
        'a_materno' => $request->input('a_materno'),
        'num_empleado' => $request->input('num_empleado'),
        'telefono' => $request->input('telefono'),
        'cargo' => $request->input('cargo'),
        'campus' => $request->input('campus'),
        'email' => $request->input('email'),
        'password' => $request->input('password'),

        'role_id' => $role->id 
       
        // Agrega otros campos del usuario
    ]);
    

    return redirect()->route('usuarios.principal');


}

public function show($id)
{
    $user = User::find($id);
    return view('users.show', compact('user'));
}

public function edit($id)
{
    $user = User::find($id);
    return view('users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    // Valida y actualiza el usuario
}

public function destroy($id)
{
    // Elimina el usuario
}

}
