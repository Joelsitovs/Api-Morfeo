<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeUserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;

class AuthController extends Controller
{
    function register(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email|unique:users,email',
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => explode('@', $fields['email'])[0],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $user->assignRole('usuario');
        Mail::to($user->email)->send(new WelcomeUserMail($user));

        Auth::login($user);


        return response([
            'user' => $user,
            'roles' => $user->getRoleNames(),
        ], 201);

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
        $user = Auth::user();

        return response()->json([
            'user' => $request->user(),
            'roles' => $user->getRoleNames('name'),

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
            $user = User::where('email', $firebaseUser->email)->first();

            if (!$user) {
                // Usuario nuevo, lo creamos
                $user = User::create([
                    'email' => $firebaseUser->email,
                    'name' => $firebaseUser->displayName ?? 'Usuario Firebase',
                    'firebase_uid' => $firebaseUser->uid,
                    'password' => bcrypt(Str::random(40)),
                ]);

                $user->assignRole('usuario');
            } else {
                $user->firebase_uid = $firebaseUser->uid;
                $user->name = $firebaseUser->displayName ?? $user->name;
                $user->save();

            }
            Auth::login($user);
            $request->session()->regenerate();

            return response()->json(['user' => $user, 'roles' => $user->getRoleNames(),]);
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
