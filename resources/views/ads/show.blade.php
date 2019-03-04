@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="player">
                    <video autoplay id="adVid" data-ad="{{$ad->id}}">
                        <source src="{{url('/')}}/storage/ad_vid/{{$ad->vid_uri}}" type="video/mp4">
                    </video>

                    <div class="player_control">
                        <div class="progress">
                            <div class="progress-bar" role="progress" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="left-control">
                            <button class="playToggle"><i class="fas fa-play"></i></button>
                            <button class="muteToggle"><i class="fas fa-volume-up"></i></button>
                            <input type="range" name="volume" min="0" max="1" class="vol" step="0.05">
                            <p class="playback-time m-0"></p>
                        </div>
                        
                        <div class="right-control">
                            <button class="fullScreen"><i class="fas fa-expand"></i></button>
                        </div>
                    </div>
                </div>
                <h1>{{$ad->title}}</h1>
                <p>{{$ad->body}}</p>
            </div>
        </div>
    </div>
@endsection