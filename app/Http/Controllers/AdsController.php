<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ads;
use Auth;

class AdsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ads::paginate(10);
        return view('ads.index')->with('ads', $ads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasRole('advertiser')) {
            return abort('401');
        }
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|regex:/^[\w ]+$/',
            'description' => 'required|string|regex:/^[\w\s]+$/',
            'video' => 'nullable|mimes:mp4|max:19999',
        ]);

        if(!Auth::user()->hasRole('advertiser')) {
            return abort('401');
        }

        if($request->hasFile('video')) {
            if( $request->file('video')->isValid() ) {
                $vidWithExt = $request->file('video')->getClientOriginalName();
                $vidName = pathinfo($vidWithExt, PATHINFO_FILENAME);
                $vidNewName = preg_replace('/[\s]+/', '_', $vidName);
                $vidExt = $request->file('video')->getClientOriginalExtension();
                $vidToUpload = $vidNewName.'_'.time().'.'.$vidExt;
                $request->file('video')->storeAs('public/ad_vid', $vidToUpload);
            }
        }else {
            $vidToUpload = null;
        }

        $ad = new Ads;
        $ad->title = $request->input('title');
        $ad->body = $request->input('description');
        $ad->vid_uri = $vidToUpload;
        $ad->adv_id = Auth::user()->id;
        $ad->save();

        return redirect('/ads')->with('success', 'Ad Created');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $ad = Ads::findOrFail($id);
        // Generate ad token
        $ad_token = bin2hex(openssl_random_pseudo_bytes(30));
        setCookie('ad_token', $ad_token, 0);
        // Add Cookie for api_token
        if(!isset($_COOKIE['api_token'])) {
            setCookie('api_token', Auth::user()->api_token, 0);
        }
        return view('ads.show')->with('ad', $ad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasRole('advertiser')) {
            return abort('401');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasRole('advertiser')) {
            return abort('401');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasRole('advertiser')) {
            return abort('401');
        }
    }
}
