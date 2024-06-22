<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $currentUserId = Auth::id();

        // Ambil semua user yang pernah mengirim atau menerima pesan dari pengguna saat ini
        $userIds = Message::where('from_user_id', $currentUserId)
                        ->orWhere('to_user_id', $currentUserId)
                        ->pluck('from_user_id')
                        ->merge(Message::where('to_user_id', $currentUserId)->pluck('to_user_id'))
                        ->unique()
                        ->filter(fn($id) => $id != $currentUserId);

        // Dapatkan informasi pengguna berdasarkan id
        $users = User::whereIn('id', $userIds)->get();

        // Dapatkan admin
        $admin = User::where('role', 'admin')->first();

        return view('chat.cs', compact('users', 'admin'));
    }

    public function fetchMessages($userId)
    {
        $currentUserId = Auth::id();
        $admin = User::where('role', 'admin')->first();

        $messages = Message::where(function ($query) use ($userId, $admin, $currentUserId) {
                if (Auth::user()->role === 'admin') {
                    $query->where(function ($q) use ($userId) {
                        $q->where('from_user_id', Auth::id())->orWhere('to_user_id', Auth::id());
                    })
                    ->where(function ($q) use ($userId) {
                        $q->where('from_user_id', $userId)->orWhere('to_user_id', $userId);
                    });
                } else {
                    $query->where('from_user_id', $currentUserId)
                          ->where('to_user_id', $admin->id)
                          ->orWhere('to_user_id', $currentUserId)
                          ->where('from_user_id', $admin->id);
                }
            })
            ->with('sender') // Assumes 'sender' relationship is defined in the Message model
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $currentUserId = Auth::id();
        $admin = User::where('role', 'admin')->first();

        $message = new Message();
        $message->from_user_id = $currentUserId;
        $message->to_user_id = $request->to_user_id ? $request->to_user_id : $admin->id;
        $message->message = $request->message;
        $message->save();

        return response()->json(['status' => 'Message Sent!']);
    }
}
