
@extends('layouts.layout')

@section('content')

  <div class="container">
    <div>
      <h1>Enable Google Authenticator</h1>
    </div>
    <?php if (isset($errorMessage)): ?>
      <div class="alert alert-error">
        <button class="close" type="button" data-dismiss="alert">&times;</button>
        <span id="error_message"><?=$errorMessage?></span>
      </div>
    <?php endif ?>

    <?php if (Auth::user()->enableTfaViaApp): ?>
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <span id="you_are_set">You are set up for Two-Factor Authentication via Google Authenticator!</span>
      </div>
    <?php else: ?>
      <div>
        <ol>
          <li>
            <a id="install" href="http://support.google.com/accounts/bin/answer.py?hl=en&amp;answer=1066447">
              Install Google Authenticator
            </a>
            on your phone
          </li>
          <li>Open the Google Authenticator app.</li>
          <li>Tap menu, then tap "Set up account", then tap "Scan a barcode".</li>
          <li>Your phone will now be in a "scanning" mode. When you are in this mode, scan the barcode below:</li>
        </ol>
      </div>
      <img src="/auth-qr-code.png" style="width: 300px; height: 300px;">
      <div>
        <p>Once you have scanned the barcode, enter the 6-digit code below:</p>
      </div>
      <form method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
          <label>Verification code</label>
          <input type="text" name="token" placeholder="123456"/>
          <br/>
          <button type="submit" class="btn">Submit</button>
          <a href="/user" class="btn">Cancel</a>
        </fieldset>
      </form>
    <?php endif ?>

  </div>

@endsection