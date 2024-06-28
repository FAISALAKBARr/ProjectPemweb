<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.index', compact('users'));
    }

    public function block($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->blocked = true;
            $user->save();
        }
        return redirect()->route('admin.index')->with('status', 'User berhasil diblokir.');
    }

    public function unblock($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->blocked = false;
            $user->save();
        }
        return redirect()->route('admin.index')->with('status', 'User berhasil diaktifkan kembali.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return redirect()->route('admin.index')->with('status', 'User berhasil dihapus.');
    }
}

