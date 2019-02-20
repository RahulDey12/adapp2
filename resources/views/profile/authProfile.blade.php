    <a href="{{url('profile/edit')}}" class="btn btn-outline-dark btn-sm">Edit Profile</a>
    {{-- About Section --}}
    <div class="col-12 profile-sec">
        <h2>About</h2>
        {{-- Bio --}}
        @if($profile_meta->where('meta_key', 'meta_bio')->first()->meta_value !== null)
            <p>{{ $profile_meta->where('meta_key', 'meta_bio')->first()->meta_value }}<p>
        @else
            <p><a href="{{url('profile/edit')}}#bio" class="btn btn-outline-dark btn-sm">Add Bio</a></p>
        @endif
        <br>
        {{-- Date Of Birth --}}
        @if( $profile_meta->where('meta_key', 'meta_dob')->first()->meta_value !== null )
            <p>Date Of Birth: {{ date('d-m-Y', strtotime($profile_meta->where('meta_key', 'meta_dob')->first()->meta_value)) }}</p>
        @else
            <p><a href="{{url('profile/edit')}}#dob" class="btn btn-outline-dark btn-sm">Add Date Of Birth</a></p>
        @endif
        <br>
        {{-- Job --}}
        @if( $profile_meta->where('meta_key', 'meta_job')->first()->meta_value !== null )
            <p>Job: {{ $profile_meta->where('meta_key', 'meta_job')->first()->meta_value }}</p>
        @else
            <p><a href="{{url('profile/edit')}}#job" class="btn btn-outline-dark btn-sm">Add Job</a></p>
        @endif
    </div>
    {{-- Contact Section --}}
    <div class="col-12 profile-sec">
        <h2>Contact</h2>
        <ul class="list-unstyled">
            <li><i class="fas fa-envelope"></i> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
        </ul>
    </div>
