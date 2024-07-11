@component('mail::message')

Hi <b>{{ $user->name }}</b>,

<p>You're almost already to start enjoying the benefits of E-Commerce_VC.</p>


<p>Simply click the button below to verify your email address.</p>

<p>
@component('mail::button', ['url' => url('activate/'.base64_encode($user->id))])
Verify
@endcomponent
</p>

<p>This will verify your email address, and then you'll officially be a part of E-Commerce_VC.</p>

@endcomponent
