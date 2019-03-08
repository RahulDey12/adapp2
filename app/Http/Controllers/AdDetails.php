<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdsDetails;
use App\Http\Resources\AdsDetails as AdsDetailsResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
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
        $details = AdsDetails::all();

        return AdsDetailsResource::collection($details);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( ! $request->ajax()) {
            $message = json_encode(['Message' => 'Only ajax requests are allowed']);
            return response($message, 403);
        }
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
        try {
            $details = AdsDetails::findOrFail($id);
        }catch (ModelNotFoundException $e) {

            return response()->json([
                'message' => 'Details Not Found',
            ], 404);

        }
        return new AdsDetailsResource($details);
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
        try {
            $details = AdsDetails::findOrFail($id);
        }catch (ModelNotFoundException $e) {

            return response()->json([
                'message' => 'Details Not Found',
            ], 404);

        }

        if($request->input('ad_token') === $details->token) {
            $data = $request->input('data');

            switch ($data) {
                case 'play': 
                    return $this->actionUpdate('play', $data, $details);
                    break;
                case 'paused':
                    $details->session_data = $this->actionUpdate('paused', $data);
                    $details->save();
                    return new AdsDetailsResource($details);
                    break;
                case 'finished':
                    $details->session_data = $this->actionUpdate('finished', $data);
                    $details->save();
                    return new AdsDetailsResource($details);
                    break;
                default:
                    return response()->json([
                        'message'   =>  'Unrecorganised Action'
                    ], 400);
            }
        }else {
            return response()->json([
                'message' =>    'Ad Token Not Matched'
            ], 403);
        }
    }

    protected function actionUpdate(string $action, string $data, $details) {
        if(empty($details->session_data)) {
            $action_data = array();
            $time = Carbon::now();
            $session_data = array($time->toDateTimeString() => $data);
            array_push($action_data, $session_data);

            $details->session_data = json_encode($action_data);
            $details->save();
            return new AdsDetailsResource($details);
            
        }else {
            $action_data = json_decode($details->session_data, true);

            $time = Carbon::now();
            $new_data = array($time->toDateTimeString() => $data);
            array_push($action_data, $new_data);

            $details->session_data = json_encode($action_data);
            $details->save();
            return new AdsDetailsResource($details);
        }
    }
}
