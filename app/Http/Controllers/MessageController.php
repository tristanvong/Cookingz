<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function privateMessages(User $user)
    {
        $messages = Message::where(function($query) use ($user) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $user->id)
                ->where('type', 'private');
        })->orWhere(function($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', auth()->id())
                ->where('type', 'private');
        })
        ->orderBy('created_at', 'desc')
        ->get();

        \Log::info($messages);
    
        return view('messages.private', compact('messages', 'user'));
    }

    public function storePrivate(Request $request, User $user)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to send a message.');
        }
    
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
    
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id, 
            'content' => $request->content,
            'type' => 'private',
        ]);
    
        return redirect()->route('messages.private', $user->id);
    }

    public function storePublic(Request $request, User $user)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to post a message.');
        }
    
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
    
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'content' => $request->content,
            'type' => 'public',
        ]);
    
        return redirect()->route('profile.show', $user->id);
    }

    public function conversations()
    {
        $conversations = User::whereHas('sentMessages', function ($query) {
            $query->where('receiver_id', auth()->id())->where('type', 'private');
        })
        ->orWhereHas('receivedMessages', function ($query) {
            $query->where('sender_id', auth()->id())->where('type', 'private');
        })
        ->with(['sentMessages' => function ($query) {
            $query->where('receiver_id', auth()->id())->where('type', 'private')->latest()->limit(1);
        }, 'receivedMessages' => function ($query) {
            $query->where('sender_id', auth()->id())->where('type', 'private')->latest()->limit(1); 
        }])
        ->get();
    
        return view('messages.conversations', compact('conversations'));
    }
    
    
}
