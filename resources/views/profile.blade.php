@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @if($profile_meta->where('meta_key', 'meta_profile_pic')->first()->meta_value !== null)
                    <div class="profile-img"><img src="storage/profile_img/{{ $profile_meta->where('meta_key', 'meta_profile_pic')->first()->meta_value }}" alt="" class="img-fluid"></div>
                @else
                    <div class="profile-img"><img src="storage/profile_img/user.svg" alt="" class="img-fluid"></div>
                @endif
            </div>
            <div class="col-12 text-center mt-3">
                <h1>{{ $user->name }}</h1>
                <p class="profile-username">&commat;{{ $user->username }}</p>
                @foreach($user->roles as $role)
                    <p class="role-name btn">{{$role->name}}</p>
                @endforeach
            </div>
            @if($user->id === Auth::user()->id)
                @include('profile.authProfile')
            @else
                @include('profile.userProfile')
            @endif
        </div>
    </div>
@endsection