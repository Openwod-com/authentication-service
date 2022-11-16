<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $user = User::where('email', $validated['email'])->first();
            if ($user == null) {
                // returns "Invalid credientials" on both invalid password and if the email doens't exist. To not expose more information than nessesary.
                return ["status" => "failed", "error" => "Invalid credentials"];
            }
            $payload = $this->_generate_payload($validated['email'], $user->admin);
            $jwt = JWT::encode($payload, $priv_key, 'RS256');
            return ["status" => "success", "jwt" => $jwt];
        } else {
            return ["status" => "failed", "error" => "Invalid credentials"];
        }
    }

    private function _generate_payload($email, $isAdmin) {
        return [
            'iss' => config('services.jwt.iss'),
            'aud' => config('services.jwt.aud'),
            'exp' => now()->addMinutes(config('services.jwt.expire_minutes'))->timestamp,
            'iat' => now()->timestamp,
            'nbf' => now()->timestamp,
            'email' => $email,
            'admin' => $isAdmin
        ];
    }
}
