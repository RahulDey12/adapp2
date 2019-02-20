{{-- About Section --}}
<div class="col-12 profile-sec">
    <h2>About</h2>
    {{-- Bio --}}
    @if($profile_meta->where('meta_key', 'meta_bio')->first()->meta_value !== null)
        <p>{{ $profile_meta->where('meta_key', 'meta_bio')->first()->meta_value }}<p>
    @else
        <p>No Bio yet</p>
    @endif
    <br>
    {{-- Date Of Birth --}}
    @if( $profile_meta->where('meta_key', 'meta_dob')->first()->meta_value !== null )
        <p><b>Date Of Birth</b>: {{ date('d-m-Y', strtotime($profile_meta->where('meta_key', 'meta_dob')->first()->meta_value)) }}</p>
        <br>
    @endif
    {{-- Job --}}
    @if( $profile_meta->where('meta_key', 'meta_job')->first()->meta_value !== null )
        <p><b>Job</b>: {{ $profile_meta->where('meta_key', 'meta_job')->first()->meta_value }}</p>
    @endif
</div>
{{-- Contact Section --}}
<div class="col-12 profile-sec">
    <h2>Contact</h2>
    <ul class="list-unstyled">
        <li><i class="fas fa-envelope"></i> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
    </ul>
</div>
