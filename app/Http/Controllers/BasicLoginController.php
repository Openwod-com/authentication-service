<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Firebase\JWT\JWT;

class BasicLoginController extends Controller
{

    public function index(Request $request)
    {
        // Returns error if invalid.
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($validated)) {
            $priv_key = file_get_contents(storage_path('keys/sign_jwt'));
            $payload = $this->_generate_payload($validated['email']);
            $jwt = JWT::encode($payload, $priv_key, 'RS256');
            return ["status" => "success", "jwt" => $jwt];
        } else {
            return ["status" => "failed", "error" => "Invalid credentials"];
        }
    }

    private function _generate_payload($email) {
        return [
            'iss' => config('services.jwt.iss'),
            'aud' => config('services.jwt.aud'),
            'exp' => now()->addMinutes(config('services.jwt.expire_minutes'))->timestamp,
            'iat' => now()->timestamp,
            'nbf' => now()->timestamp,
            'email' => $email
        ];
    }
}
