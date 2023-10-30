<?php

namespace App\Http\Controllers\Auth;

use App\Models\Registro; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Verifica si el usuario tiene is_active igual a 1
    protected function is_active($user)
    {
        return $user->is_active == 1;
    }

    // Sobrescribe el método authenticated
    protected function authenticated(Request $request, $user)
    {
        if ($this->is_active($user)) {
            // Guardar registro
            $registro = new Registro();
            $registro->users_id = $user->id; 
            $registro->fecha_hora = now();
            $registro->direccion_ip = $request->ip();
            $registro->exito = true;
            $registro->save();

            return redirect()->intended($this->redirectPath());
        } else {
            // Si el usuario tiene is_active igual a 0, denegar el acceso y cerrar sesión
            Auth::logout();
            return redirect()
                ->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Tu cuenta está desactivada. Contacta al administrador.']);
        }
    }
}
