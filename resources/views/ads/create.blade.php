@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
               {!! Form::open(['action' => 'AdsController@store', 'method' => 'POST']) !!}
                    {{-- Title --}}
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Ad Title']) !!}
                    </div>
                    {{-- Description --}}
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', '', ['class' => 'form-control']) !!}
                    </div>
                    {{-- Video --}}
                    <div class="form-group">
                        {!! Form::label('video', 'Upload Video') !!}
                        {!! Form::file('video', ['class' => 'form-control-file']) !!}
                    </div>
                    {!! Form::submit('Create', ['class' => 'btn btn-outline-success btn-block']) !!}
               {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection