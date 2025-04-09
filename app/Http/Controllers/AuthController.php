<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard'); // Si ya está autenticado, redirigir al dashboard
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard'); // Redirigir al dashboard después del login
        }

        return back()->with('error', 'Credenciales incorrectas.');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard'); // Si ya está autenticado, redirigir al dashboard
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:6|confirmed',
            'rol_id' => 'required|exists:roles,id', // Verificar que el rol existe en la tabla roles
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id, // Tomar el rol seleccionado en el formulario
        ]);

        Auth::login($usuario); // Iniciar sesión automáticamente después del registro

        return redirect()->route('dashboard')->with('success', 'Registro exitoso.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
