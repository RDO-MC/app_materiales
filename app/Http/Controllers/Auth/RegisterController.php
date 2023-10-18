<?php

namespace App\Http\Controllers\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
   
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:20'],
            'a_paterno' => ['required', 'string', 'max:20'],
            'a_materno' => ['required', 'string', 'max:20'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
      

        $user = User::create([
            'nombre' => $data['nombre'],
            'a_paterno' => $data['a_paterno'],
            'a_materno' => $data['a_materno'],
            'num_empleado' => $data['num_empleado'],
            'telefono' => $data['telefono'],
            'cargo' => $data['cargo'],
            'campus' => $data['campus'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    
        // Asignar un rol al usuario, si es necesario
      
    $user->assignRole($data['role']); // Asigna el rol seleccionado en el formulario
    return $user;

    }
}
