<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            // TODO: Create JWT
        } else {
            return ["status" => "failed", "error" => "Invalid credentials"];
        }
    }
}
