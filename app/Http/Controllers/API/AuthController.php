<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    private static string $JWT_KEY = "bfkgjbjkrh9043ynfg_8mbnfmgn8945fmdlfmdsmf-3490ruj";

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $data = User::where('email', $request->email)->first(['email', 'name'])->toArray();
            $jwt = JWT::encode($data, AuthController::$JWT_KEY, 'HS256');
            return response()->json([
                "access_token" => $jwt,
                "data" => $data
            ]);
        }

        return "error";
    }
    public function get_data(Request $request)
    {
        return "masuk";
    }
}
