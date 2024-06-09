<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function block(User $user)
    {
        $user->blocked = true;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User blocked successfully.');
    }

    public function unblock(User $user)
    {
        $user->blocked = false;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User unblocked successfully.');
    }
}

