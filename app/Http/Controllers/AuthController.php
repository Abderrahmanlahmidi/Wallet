<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    public function register(Request $request):JsonResponse{
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'age' => 'required',
            'role_id' => 'required',
            'wallet_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'role_id' => $request->role_id,
            'wallet_id' => $request->wallet_id
        ]);

        if($user){
            return response()->json([
                'message' => 'User register successfully',
                'user' => $user,
            ]);
        }else{
            return response()->json([
                'message' => 'registeration failed',
            ]);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email|exists:users,email",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors(),
            ]);
        }

        $user = User::where("email", $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "message" => "the email or password is incorrect"
            ], 404);
        }

        $token = $user->createToken($user->name . "Auth-Token")->plainTextToken;

        return response()->json([
            "message" => "login success",
            "token_type" => "Bearer",
            "token" => $token,
            'user' => $user,
        ]);

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            "message" => "logout success"
        ]);
    }


}
