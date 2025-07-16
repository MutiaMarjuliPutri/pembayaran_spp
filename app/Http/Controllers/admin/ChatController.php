<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

class ChatController extends Controller
{
    // Daftar siswa yang pernah chat dengan admin
    public function index()
    {
        $users = Chat::select('sender_id')
            ->whereHas('sender', function($q){
                $q->where('role', 'siswa');
            })
            ->groupBy('sender_id')
            ->with('sender')
            ->get();
            

        return view('admin.chat.index', compact('users'));
    }

    // Lihat detail chat dengan siswa tertentu
    public function show($siswa_id)
    {
        $admin = auth()->user();

        $chats = Chat::where(function($q) use ($siswa_id, $admin) {
            $q->where('sender_id', $siswa_id)->where('receiver_id', $admin->id);
        })->orWhere(function($q) use ($siswa_id, $admin) {
            $q->where('sender_id', $admin->id)->where('receiver_id', $siswa_id);
        })->orderBy('created_at', 'asc')->get();

        $siswa = User::findOrFail($siswa_id);

        return view('admin.chat.tampilanchat', compact('chats', 'siswa'));
    }

    // Admin mengirim pesan ke siswa
    public function send(Request $request)
    {
        Chat::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'pesan' => $request->pesan
        ]);

        return redirect()->back();
}
}
