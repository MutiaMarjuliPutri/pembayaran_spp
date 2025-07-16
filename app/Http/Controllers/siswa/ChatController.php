<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

class ChatController extends Controller
{
    // Chat siswa dengan admin
    public function index()
    {
        $user = auth()->user();
        $admin = User::where('role', 'admin')->first();

        $chats = Chat::where(function($q) use ($user, $admin) {
            $q->where('sender_id', $user->id)->where('receiver_id', $admin->id);
        })->orWhere(function($q) use ($user, $admin) {
            $q->where('sender_id', $admin->id)->where('receiver_id', $user->id);
        })->orderBy('created_at', 'asc')->get();

        return view('siswa.chat.index', compact('chats', 'admin'));
    }

    public function send(Request $request)
    {
        $admin = User::where('role', 'admin')->first();

        Chat::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $admin->id,
            'pesan' => $request->pesan
        ]);

        return redirect()->back();
    }
}
