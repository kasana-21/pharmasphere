<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Purchases;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function create()
    {
        // Return a view or data for creating a new user
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function edit(User $user)
    {
        // Return a view or data for editing the specified user
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user);
    }
    public function destroy(User $user)
    {
        DB::transaction(function () use ($user) {
            Purchases::where('user_id', $user->id)->delete();
            $user->delete();
        });

        return response()->json([
            'message' => 'Deleted successfully.'], 200);
    }
    //list of all users by gender
    public function gender(){
        $male = User::where('gender', 'male')->count();
        $female = User::where('gender', 'female')->count();
    
        return response()->json([
            'male' => $male,
            'female' => $female,
        ]);
    }

    // list of all users by last login time
    public function time(){
        $users = User::orderBy('created_at', 'asc')->get();
    
        return response()->json($users);
    }
    
}
