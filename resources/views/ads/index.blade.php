@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(count($ads) > 0)
                @foreach($ads as $ad)
                <div class="col-4">
                    <h3>{{$ad->title}}</h3>
                    <p>{{substr( $ad->body, 0, 20 )}}</p>
                    <a href="{{ url('/ads/'.$ad->id) }}" class="btn btn-primary"><i class="fas fa-caret-right"></i> Watch AD</a>
                </div>
                @endforeach
            @else
                <h3>Nothing Found :(</h3>
            @endif
        </div>
    </div>
@endsection