<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;  // Asegúrate de importar Request
use Illuminate\Support\Facades\Auth;  // Asegúrate de importar Auth
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

    protected function authenticated(Request $request, $user)
    {
        // Obtener email actualizado
        $email = $user->email;

        // Resetear flags
        $user->update([
            'email_changed' => false,
            'password_changed' => false,
        ]);

        // Detectar cambios
        if ($user->wasChanged(['email', 'password'])) {

            // Cerrar sesión
            Auth::logout();

            // Autenticar de nuevo con el email actualizado
            if (Auth::attempt(['email' => $email, 'password' => $request->password])) {
                return redirect()->intended($this->redirectPath());
            }

            // Mostrar mensaje de error
            return redirect()
                ->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Credenciales incorrectas']);

        }

        // Redireccionar
        return redirect()->intended($this->redirectPath());
    }
}
