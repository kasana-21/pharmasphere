<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function generate(Request $request)
    {
        $user = Auth::user();
        $token = $user->createToken('Personal Access Token');
        return back()->with('token', $token->plainTextToken);
    }
}
