@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(count($ads) > 0)
                    @foreach($ads as $ad)

                    @endforeach
                @else
                    <h3>Nothing Found :(</h3>
                @endif
            </div>
        </div>
    </div>
@endsection