<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Firebase\JWT\JWT;

class PublicKeyController extends Controller
{

    public function index(Request $request)
    {
        return file_get_contents(storage_path('keys/sign_jwt.pub'));
    }
}
