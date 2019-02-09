<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;

class ProfileInitController extends Controller
{
    protected $redirect = '/profile';

    public function __construct() {

        $this->middleware('auth');
    }

    public function init() {

        if(count(Auth::user()->profile) >= 4 ) {
            return redirect($this->redirect);
        }

        $this->setNullRows();
        return view('profile.init');
    }

    protected function setNullRows() {
        //Date of birth
        $profile = new Profile;
        $profile->meta_key = 'meta_dob';
        $profile->user_id = Auth::user()->id;
        $profile->save();

        //Bio
        $profile = new Profile;
        $profile->meta_key = 'meta_bio';
        $profile->user_id = Auth::user()->id;
        $profile->save();

        //Job
        $profile = new Profile;
        $profile->meta_key = 'meta_job';
        $profile->user_id = Auth::user()->id;
        $profile->save();

        //Profile Image
        $profile = new Profile;
        $profile->meta_key = 'meta_profile_pic';
        $profile->user_id = Auth::user()->id;
        $profile->save();
    }
}