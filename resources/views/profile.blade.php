@extends('layouts.app')

@section('content')
    <h1>This is {{ $user->name }}'s profile</h1>
    <p>Role: @foreach($user->roles as $role)
                {{$role->name}}
            @endforeach
    </p>
    <p>Date Of Birth: {{ date('d-m-Y', strtotime($profile_meta->where('meta_key', 'meta_dob')->first()->meta_value)) }}</p>
    @if( $profile_meta->where('meta_key', 'meta_job')->first()->meta_value !== null )
        <p>Job: {{ $profile_meta->where('meta_key', 'meta_job')->first()->meta_value }}</p>
    @else
        <p><a href="{{url('profile/edit')}}#job" class="btn btn-dark">Add Job</a></p>
    @endif
@endsection