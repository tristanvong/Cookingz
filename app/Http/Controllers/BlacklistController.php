<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blacklist;
use App\Models\User;


class BlacklistController extends Controller
{
    public function index()
    {
        $blacklistedUsers = Blacklist::with('user')->get();
        return view('admin.users.blacklist.index', compact('blacklistedUsers'));
    }

    public function create()
    {
        $users = User::whereDoesntHave('blacklist')->get();
        return view('admin.users.blacklist.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'reason' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($request->user_id);

        if ($user->isBlacklisted()) {
            return redirect()->back()->with('error', 'User is already blacklisted.');
        }

        Blacklist::create([
            'user_id' => $user->id,
            'reason' => $request->reason,
        ]);

        $user->update(['is_blacklisted' => true]);

        return redirect()->back()->with('success', 'User has been blacklisted.');
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $blacklist = Blacklist::where('user_id', $userId)->first();
    
        if (!$blacklist) {
            return redirect()->back()->with('error', 'User is not blacklisted.');
        }
    
        $blacklist->delete();
        $user->update(['is_blacklisted' => false]);
    
        return redirect()->back()->with('success', 'User has been unblacklisted.');
    }
}
