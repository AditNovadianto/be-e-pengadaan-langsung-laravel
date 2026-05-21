<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penyedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required|string|max:255',
            'email_user' => 'required|string|email|max:255|unique:users',
            'password_user' => 'required|string|min:6',
            'id_role' => 'required|integer',
            'id_sistem' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'nama_user' => $request->nama_user,
            'email_user' => $request->email_user,
            'password_user' => Hash::make($request->password_user),
            'status_user' => 'ACTIVE',
            'id_sistem' => $request->id_sistem,
            'id_role' => $request->id_role,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email_user' => 'required|email',
            'password_user' => 'required'
        ]);

        $user = User::where('email_user', $request->email_user)->first();

        if (!$user || !Hash::check($request->password_user, $user->password_user)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function registerPenyedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required|string|max:255',
            'email_penyedia' => 'required|string|email|max:255|unique:penyedia',
            'password_penyedia' => 'required|string|min:6',
            'nib' => 'required|string',
            'id_sistem' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $penyedia = Penyedia::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'email_penyedia' => $request->email_penyedia,
            'password_penyedia' => Hash::make($request->password_penyedia),
            'nib' => $request->nib,
            'id_sistem' => $request->id_sistem,
        ]);

        $token = $penyedia->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $penyedia,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function loginPenyedia(Request $request)
    {
        $request->validate([
            'email_penyedia' => 'required|email',
            'password_penyedia' => 'required'
        ]);

        $penyedia = Penyedia::where('email_penyedia', $request->email_penyedia)->first();

        if (!$penyedia || !Hash::check($request->password_penyedia, $penyedia->password_penyedia)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $penyedia->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $penyedia,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getAllPenyedia()
    {
        return response()->json(Penyedia::all());
    }
}
