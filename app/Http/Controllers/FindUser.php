<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class FindUser extends Controller
{
    private $username;

    public function profile($username) {
        $this->username = $username;
        $user = User::where('username', $this->username)->first();
        if($user != null) {
            if($user->id === Auth::user()->id) {
                return redirect('/profile');
            }

            return view('profile')->with(['profile_meta' => $user->profile, 'user' => $user]);
        }else {
            return abort(404);
        }
    }
}
