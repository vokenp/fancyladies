@extends('layout.guest', ['pageclass' => 'login-forgot-on'])

@section('content')
<div class="login-forgot">
  <div class="mb-20">
    <h3>{{ config('app.name') }}</h3>
    <h4>Forgotten Password ?</h4>
    <p class="opacity-60">Enter your email to reset your password</p>
  </div>
  <form class="form" method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group">
      <input
        class="h-auto px-8 py-4 mb-3 text-white font-weight-bold placeholder-gray border-0 form-control opacity-170 bg-info rounded-pill"
        type="text" placeholder="Enter Email..." name="email" autocomplete="off" />
        
      <!-- Session Status -->
      <x-auth-session-status :status="session('status')" />

      <!-- Validation Errors -->
      <x-auth-validation-errors :errors="$errors" />
    </div>
    <div class="form-group">
      <button type="submit"
        class="py-3 m-2 btn btn-pill btn-outline-danger font-weight-bold opacity-150 px-15">Request</button>
      <a href="/" id="kt_login_forgot_cancel"
        class="py-3 m-2 btn btn-pill btn-outline-info font-weight-bold opacity-70 px-15">Cancel</a>
    </div>
  </form>
</div>
@endsection