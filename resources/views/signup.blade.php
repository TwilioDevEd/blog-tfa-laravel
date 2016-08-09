
@extends('layouts.layout')

@section('content')

  <div class="container">
    <div>
      <h1 id="create_account">Create an account</h1>
      <p>Remember, this is just for demonstration purposes. Don't use a password here that you use anywhere else.</p>
    </div>
    <?php if (isset($errorMessage)): ?>
      <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <span id="error_message"><?=$errorMessage?></span>
      </div>
    <?php endif ?>
    <form method="POST">
      <fieldset>
        <label>E-mail</label>
        <input type="email" name="email" />
        <label>Password</label>
        <input type="password" name="password1" />
        <label>Password again</label>
        <input type="password" name="password2" />
        <br/>
        <button type="submit" class="btn">Create Account</button>
      </fieldset>
    </form>
  </div>

@endsection