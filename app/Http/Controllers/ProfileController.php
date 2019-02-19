<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Profile;
use Auth;

class ProfileController extends Controller
{
    public function __construct() {

        $this->middleware(['auth', 'profile']);

    }

    public function index() {

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        return view('profile')->with(['profile_meta' => $user->profile, 'user' => $user]);
    }

    public function edit() {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        return view('profile.edit')->with('profile_meta', $user->profile);
    }

    public function update(Request $request) {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        $this->validate($request, [
            'name' => 'nullable|string|max:50',
            'bio' => 'string|max:100|nullable',
            'dob' => 'date|nullable',
            'job' => 'string|nullable',
            'img' => 'nullable|mimes:jpeg,png,jpg|max:1999',
        ]);

        if($request->hasFile('img')) {
            if($request->file('img')->isValid()) {
                $imgWithExt = $request->file('img')->getClientOriginalName();
                $imgName = pathinfo($imgWithExt, PATHINFO_FILENAME);
                $imgNewName = preg_replace('/[\s]+/', '_', $imgName);
                $imgExt = $request->file('img')->getClientOriginalExtension();
                $imgToUpload = $imgNewName.'_'.time().'.'.$imgExt;
                $request->file('img')->storeAs('public/profile_img', $imgToUpload);
            }
        }else {
            $imgToUpload = null;
        }

        if($request->input('name') !== null) {
            $user->name = $request->input('name');
            $user->save();
        }
        
        foreach($user->profile as $meta) {
            
            switch($meta->meta_key) {
                case 'meta_bio':
                    $meta->meta_value = $request->input('bio');
                    $meta->save();
                break;

                case 'meta_dob':
                    $meta->meta_value = $request->input('dob');
                    $meta->save();
                break;

                case 'meta_job':
                    $meta->meta_value = $request->input('job');
                    $meta->save();
                break;

                case 'meta_profile_pic':
                    $meta->meta_value = $imgToUpload;
                    $meta->save();
                break;
            }
        }

        return redirect('/profile')->with('success', 'Profile Updated');
    }
}
