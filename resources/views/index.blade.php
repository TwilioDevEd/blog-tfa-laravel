
@extends('layouts.layout')

@section('content')

  <div class="container">
    <div class="row">
      <div class="span6">
        <div>
          This is a demonstration of how to add TOTP based Two-Factor Authentication to an existing application.
        </div>
        <!-- Source: -->
        <!-- http://openclipart.org/detail/34273/tango-system-lock-screen-by-warszawianka -->
        <img src="/static/img/locked-screen.png" />
      </div>
      <div class="span6">

        <?php if (isset($errorMessage)): ?>
          <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <span id="error_message"><?=$errorMessage?></span>
          </div>
        <?php endif ?>
        <form method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <fieldset>
            <label>Username</label>
            <input id="username" type="text" name="username">
            <label>Password</label>
            <input id="password" type="password" name="password">
            <br/>
            <button type="submit" class="btn">Log in</button>
          </fieldset>
        </form>
        <div class="well">
          <div>
            <h1>
              Don't have an account?
            </h1>
          </div>
          <a class="btn" href="/sign-up/">
            Sign up for an account here
          </a>
        </div>
      </div>
    </div>
  </div>

@endsection