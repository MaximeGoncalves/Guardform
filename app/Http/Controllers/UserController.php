<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index()
    {
        return inertia('User/Index', [
            'users' => User::all()
        ]);
    }

    public function create()
    {
        return inertia('User/Create');
    }

    public function edit(User $user)
    {
        return inertia('User/Edit', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        User::create(array_merge($request->all(), [
            'password' => bcrypt('password')
        ]));
        return redirect()->route('users.index');
    }
}
