<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdsDetails;
use App\Http\Resources\AdsDetails as AdsDetailsResource;
use Auth;

class AdDetails extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deatils = AdsDetails::all();

        return AdsDetailsResource::collection($deatils);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $details = new AdsDetails;
        $details->user_id = Auth::guard('api')->user()->id;
        $details->ad_id = $request->input('ad_id');
        $details->token = $request->input('ad_token');
        $details->session_data = '';

        if($details->save()) {
            return new AdsDetailsResource($details);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return $request->header();
    }
}
