<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function store(Request $request,  Role $role)
    {
        $this->validate($request, [
            'nombre' => ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'a_paterno' => ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'a_materno' => ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'num_empleado' => ['required', 'numeric', Rule::unique('users', 'num_empleado')],
            'telefono' => ['required', 'string', 'regex:/^[0-9]+$/', 'size:10'],
            'cargo' => ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'campus' => ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+/', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'alpha_num', 'min:8'],
            'role' => 'required|exists:roles,name',
        ]);
    
        // Limpia y formatea los datos antes de guardarlos
        $nombre = ucwords(strtolower(trim($request->input('nombre'))));
        $a_paterno = ucwords(strtolower(trim($request->input('a_paterno'))));
        $a_materno = ucwords(strtolower(trim($request->input('a_materno'))));
        $telefono = preg_replace('/[^0-9]/', '', $request->input('telefono'));
        $num_empleado = preg_replace('/[^0-9]/', '', $request->input('num_empleado'));
        $cargo = ucwords(strtolower(trim($request->input('cargo'))));
        $campus = ucwords(strtolower(trim($request->input('campus'))));
        $email = strtolower(trim($request->input('email')));
        $password = bcrypt($request->input('password'));
    
        $role = Role::where('name', $request->role)->first();
    
        $user = User::create([
            'nombre' => $nombre,
            'a_paterno' => $a_paterno,
            'a_materno' => $a_materno,
            'num_empleado' => $request->input('num_empleado'),
            'telefono' => $telefono,
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
            'nombre' => ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+$/'],
            'a_paterno' => ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+$/'],
            'a_materno' => ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+$/'],
            'num_empleado' => ['required', 'numeric', Rule::unique('users', 'num_empleado')->ignore($user->id)],
            'telefono' => ['required', 'string', 'regex:/^[0-9]+$/', 'size:10'],
            'cargo' => ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+$/'],
            'campus' => ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+$/'],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
                        Rule::unique('users', 'email')->ignore($user->id)],
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
