@extends('layouts.app')

@section('content')
<section id="login">
  <div class="box">
    <div class="inner">
      <h2>Login Administradores</h2>
      <form method="POST" action="{{ route('admin.login.submit') }}">
        {{ csrf_field() }}
        <div class="field-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">E-Mail</label>
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
          @if ($errors->has('email'))
            <span class="error">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>
        <div class="field-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label">Clave</label>
          <input id="password" type="password" class="form-control" name="password" required>
          <a href="{{ route('password.request') }}">¿Olvidó clave?</a>
          @if ($errors->has('password'))
            <span class="error">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>
        <div class="field-group">
          <div class="check">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label>Recuérdame</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>
</section>
@endsection
