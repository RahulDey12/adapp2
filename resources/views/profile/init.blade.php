@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8" data-spy="scroll" data-offset="0">
                <?php $invalid_class = 'form-control is-invalid' ?>
                {!! Form::open(['action' => 'ProfileController@update', 'method' => 'POST']) !!}
                    {{-- Bio --}}
                    <div class="form-group">
                        {!! Form::label('bio', 'Your Bio') !!}
                        {!! Form::textarea('bio', '', ['class' => $errors->has('bio') ? $invalid_class : 'form-control', 'id' => 'bio']) !!}
                        @if($errors->has('bio'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('bio') }}</strong>
                            </span>
                        @endif
                    </div>
                    {{-- Date of birth --}}
                    <div class="form-group">
                        {!! Form::label('dob', 'Date Of Birth') !!}
                        {!! Form::date('dob', '', ['class' => $errors->has('dob') ? $invalid_class : 'form-control', 'id' => 'dob']) !!}
                        @if($errors->has('dob'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dob') }}</strong>
                            </span>
                        @endif
                    </div>
                    {{-- Job --}}
                    <div class="form-group">
                        {!! Form::label('job', 'Job') !!}
                        {!! Form::text('job', '', ['class' => $errors->has('job') ? $invalid_class : 'form-control', 'id' => 'job']) !!}
                        @if($errors->has('job'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('job') }}</strong>
                            </span>
                        @endif
                    </div>
                    {{-- Profile img --}}
                    {!! Form::hidden('_method', 'PUT') !!}
                    <a href="{{url('/home')}}" class="btn btn-info">Skip</a>
                    {!! Form::submit('Update Profile', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection