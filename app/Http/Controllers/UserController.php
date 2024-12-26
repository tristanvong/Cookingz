<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //TODO: add exceptions if users are not found
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/');
    }

    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->role = User::ADMIN;
        $user->save();
        return redirect('/');
    }
}
