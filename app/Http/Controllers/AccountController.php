<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function store(Request $request)
    {
        /** @var \Openwod\ServiceAccounts\Models\ServiceAccount */
        $svc = auth()->guard('svc')->user();
        if($svc == null || !$svc->tokenCan('account.create'))
            return ["status" => "error", "error" => "authentication denied"];

        $validated = $request->validate([
            'user_id' => 'required|numeric',
            'email' => 'required|email',
            'password' => 'required',
            'admin' => 'boolean'
        ]);

        $user = new User([
            'user_id' => $validated['user_id'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'admin' => isset($validated['admin']) && $validated['admin'] == true
        ]);
        $user->save();

        return response(['status' => 'success'], 201);
    }
}
