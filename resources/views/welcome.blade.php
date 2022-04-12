@extends('layout.guest', ['pageclass' => 'login-signin-on'])

@section('content')
<!--begin::Login Sign in form-->
<div class="login-signin">
  <div class="mb-20">
    <h1 class="text-4xl">Welcome to {{ config('app.name') }}</h1>
    <p class="opacity-60 "></p>
  </div>

  <div class="mt-10 text-center form-group">
    <a href="/login"
      class="px-8 py-3 btn btn-pill btn-outline-success ">Get Started!</a>
  </div>
</div>
<!--end::Login Sign in form-->
@endsection