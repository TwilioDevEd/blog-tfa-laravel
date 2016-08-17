
@extends('layouts.layout')

@section('content')

  <div class="container">
    <div>
      <h1 id="logged_in">You are logged in.</h1>
    </div>
    <div class="row">
      <div class="span6">
        <!-- Source: http://openclipart.org/detail/176289/top-secret-by-joshbressers-176289 -->
        <img src="/img/top-secret.png" />
      </div>
      <div class="span6">
        <a class="btn" href="/enable-tfa-via-app/">Enable app based authentication</a>
        <div>
          <p>
            For apps like "Google Authenticator".
            <br/>
            @if (Auth::check() && Auth::user()->enableTfaViaApp)
              (Enabled)
            @endif
          </p>
        </div>
        <a class="btn" href="/enable-tfa-via-sms/">Enable SMS based authentication</a>
        <div>
          <p>
            For any phone that can receive SMS messages.
            <br/>
            @if (Auth::check() && Auth::user()->enableTfaViaSms):
              (Enabled for {{ Auth::user()->phoneNumber }})
            @endif
          </p>
      </div>
    </div>
    </div>
  </div>

@endsection