
@extends('layouts.layout')

@section('content')

  <div class="container">
    <div class="well">
      <div>
        <h1>Account Verification</h1>
        @if (isset($errorMessage))
          <div class="alert alert-error">
            <button class="close" type="button" data-dismiss="alert">&times;</button>
            <span id="error_message">{{ $errorMessage }}</span>
          </div>
        @endif

        <p>Please enter your verification code from:<p>
        <ul>
          @if (isset($user) && $user->enableTfaViaSms)
            <li>The SMS that was just sent to you</li>
          @endif
          @if (isset($user) && $user->enableTfaViaApp)
            <li id="google_authenticator">Google Authenticator</li>
          @endif
        </ul>
      </div>
      <form method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
          <label>Enter your verification code here:</label>
          <input type="text" name="token" placeholder="123456"/>
          <br/>
          <button type="submit" class="btn">Submit</button>
        </fieldset>
      </form>
      <div>
        <p>
          @if (isset($user) && $user->enableTfaViaSms)
            <a id="send-sms-again-link" href="/verify-tfa/">
              Send me an SMS with my verification code again.
            </a>
          @endif
        </p>
      </div>
    </div>
  </div>

@endsection