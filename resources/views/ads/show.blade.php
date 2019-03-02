@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <video autoplay id="ad" data-ad="{{$ad->id}}">
                    <source src="{{url('/')}}/storage/ad_vid/{{$ad->vid_uri}}" type="video/mp4">
                </video>
                <h1>{{$ad->title}}</h1>
                <p>{{$ad->body}}</p>
            </div>
        </div>
    </div>
@endsection