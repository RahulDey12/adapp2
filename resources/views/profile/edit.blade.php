@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8" data-spy="scroll" data-offset="0">
                <?php $invalid_class = 'form-control is-invalid' ?>
                {!! Form::open(['action' => 'ProfileController@update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    {{-- Name --}}
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', Auth::user()->name, ['class' => $errors->has('name') ? $invalid_class : 'form-control', 'id' => 'name']) !!}
                        @if($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    {{-- Bio --}}
                    <div class="form-group">
                        @if($profile_meta->where('meta_key', 'meta_bio')->first()->meta_value !== null)
                            {!! Form::label('bio', 'Your Bio') !!}
                            {!! Form::textarea('bio', $profile_meta->where('meta_key', 'meta_bio')->first()->meta_value, ['class' => $errors->has('bio') ? $invalid_class : 'form-control', 'id' => 'bio']) !!}
                        @else
                            {!! Form::label('bio', 'Your Bio') !!}
                            {!! Form::textarea('bio', '', ['class' => $errors->has('bio') ? $invalid_class : 'form-control', 'id' => 'bio']) !!}
                        @endif
                        @if($errors->has('bio'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('bio') }}</strong>
                            </span>
                        @endif
                    </div>
                    {{-- Date of birth --}}
                    <div class="form-group">
                        @if($profile_meta->where('meta_key', 'meta_dob')->first()->meta_value !== null)
                            {!! Form::label('dob', 'Date Of Birth') !!}
                            {!! Form::date('dob', $profile_meta->where('meta_key', 'meta_dob')->first()->meta_value, ['class' => $errors->has('dob') ? $invalid_class : 'form-control', 'id' => 'dob']) !!}
                        @else
                            {!! Form::label('dob', 'Date Of Birth') !!}
                            {!! Form::date('dob', '', ['class' => $errors->has('dob') ? $invalid_class : 'form-control', 'id' => 'dob']) !!}
                        @endif
                        @if($errors->has('dob'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dob') }}</strong>
                            </span>
                        @endif
                    </div>
                    {{-- Job --}}
                    <div class="form-group">
                        @if($profile_meta->where('meta_key', 'meta_job')->first()->meta_value !== null) 
                            {!! Form::label('job', 'Job') !!}
                            {!! Form::text('job', $profile_meta->where('meta_key', 'meta_job')->first()->meta_value, ['class' => $errors->has('job') ? $invalid_class : 'form-control', 'id' => 'job']) !!}
                        @else
                            {!! Form::label('job', 'Job') !!}
                            {!! Form::text('job', '', ['class' => $errors->has('job') ? $invalid_class : 'form-control', 'id' => 'job']) !!}
                        @endif
                        @if($errors->has('job'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('job') }}</strong>
                            </span>
                        @endif
                    </div>
                    {{-- Profile img --}}
                    <div class="form-group">
                        {!! Form::label('img', 'img') !!}
                        {!! Form::file('img', ['class' => $errors->has('img') ? $invalid_class : 'form-control-file', 'id' => 'img']) !!}
                        @if($errors->has('img'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('img') }}</strong>
                            </span>
                        @endif
                    </div>
                    {!! Form::hidden('_method', 'PUT') !!}
                    {!! Form::submit('Update Profile', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection