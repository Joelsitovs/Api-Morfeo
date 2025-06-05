<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;

class AuthController extends Controller
{
    function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),

        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciales inválidas.'],
            ]);
        }

        $request->session()->regenerate();

        return response()->json([
            'user' => $request->user(),
            'message' => 'Inicio de sesión exitoso',
        ]);
    }

    public function loginWithFirebase(Request $request)
    {
        $idToken = $request->input('id_token');

        try {
            if (!$idToken) {
                return response()->json(['error' => 'No se recibió ningún ID token'], 422);
            }

            $auth = (new Factory)
                ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
                ->createAuth();

            $verifiedIdToken = $auth->verifyIdToken($idToken);
            $uid = $verifiedIdToken->claims()->get('sub');

            $firebaseUser = $auth->getUser($uid);

            $user = \App\Models\User::updateOrCreate(
                ['email' => $firebaseUser->email],
                [
                    'name' => $firebaseUser->displayName ?? 'Usuario Firebase',
                    'firebase_uid' => $firebaseUser->uid,
                    'password' => bcrypt(Str::random(40)),
                ]
            );

            Auth::login($user);
            $request->session()->regenerate();

            return response()->json(['user' => $user]);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Token inválido o error interno'], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout exitoso']);
    }

}
