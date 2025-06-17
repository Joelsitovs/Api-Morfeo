<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user->hasRole('admin')) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $users = User::with('roles')
            ->select('id', 'name', 'email', 'created_at')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at,
                    'roles' => $user->getRoleNames(),
                ];
            });

        return response()->json($users);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();

        if (!$user->hasRole('admin')) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $data = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255',
            'role' => 'string',
        ]);

        $targetUser = User::findOrFail($id);
        $targetUser->update([
            'name' => $data['name'] ?? $targetUser->name,
            'email' => $data['email'] ?? $targetUser->email,
        ]);

        if (isset($data['role'])) {
            $targetUser->syncRoles([$data['role']]); // Convertimos a array
        }

        return response()->json([
            'message' => 'Usuario actualizado',
            'user' => [
                'id' => $targetUser->id,
                'name' => $targetUser->name,
                'email' => $targetUser->email,
                'created_at' => $targetUser->created_at,
                'roles' => $targetUser->getRoleNames(),
            ]
        ]);
    }
    public function destroy(Request $request, $id)
    {
        $user = $request->user();

        if (!$user->hasRole('admin')) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $targetUser = User::findOrFail($id);
        $targetUser->delete();

        return response()->json(['message' => 'Usuario eliminado']);
    }

}
