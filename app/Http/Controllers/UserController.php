<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::all();
        if ($search) {
            $users = User::query()
                ->where('nombre', 'like', "%$search%")
                ->orWhere('a_paterno', 'like', "%$search%")
                ->orWhere('a_materno', 'like', "%$search%")
                ->orWhere('num_empleado', 'like', "%$search%")
                ->orWhere('telefono', 'like', "%$search%")
                ->orWhere('cargo', 'like', "%$search%")
                ->orWhere('campus', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->get();
        
        }
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

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('usuarios.principal')
            ->with('success', 'Usuario eliminado exitosamente');
    }
}
