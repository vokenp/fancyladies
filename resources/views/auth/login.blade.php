@extends('layout.guest', ['pageclass' => 'login-signin-on'])

@section('content')
<!--begin::Login Sign in form-->
<div class="login-signin ">
  <div class="mb-20">
    <h3>WELCOME TO {{ config('app.name') }}</h3>
    <p class="opacity-60">Enter your details to login to your account:</p>
  </div>

  <!-- Session Status -->
  {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

  <form class="form" id="kt_login_signin_form2" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
      <input
        class="h-auto px-8 py-4 mb-3 text-white font-weight-bold placeholder-gray border-0 form-control opacity-170 bg-info rounded-pill"
        id="username" type="text" placeholder="Enter User Name" name="username"  autocomplete="off" />
    </div>
    <div class="form-group">
      <input
        class="h-auto px-8 py-4 mb-3 text-white font-weight-bold placeholder-gray border-0 form-control opacity-170 bg-info rounded-pill"
        type="password" placeholder="Password" name="password" id="password" class="block w-full mt-1" type="password"
        wire:name="password" required autocomplete="current-password" />

      <!-- Validation Errors -->
      <x-auth-validation-errors :errors="$errors" />

      <!-- Session Status -->
      <x-auth-session-status :status="session('status')" />
    </div>

    <div class="flex-wrap px-8 form-group d-flex justify-content-between align-items-center">
      <div class="checkbox-inline">
        <label class="m-0 text-success checkbox checkbox-outline checkbox-white">
          <input type="checkbox" name="remember" />
          <span></span>Remember me</label>
      </div>
      <a href="{{ route('password.request') }}" id="kt_login_forgot" class="text-danger font-weight-bold">
        {{ __('Forgot password ?') }}
      </a>
    </div>
    <div class="mt-10 text-center form-group">
      <button id="kt_login_signin_submit2" type="submit"
        class="py-3 btn btn-pill btn-outline-success font-weight-bold opacity-150 px-15">Sign
        In</button>
    </div>
  </form>

</div>
<!--end::Login Sign in form-->
@endsection