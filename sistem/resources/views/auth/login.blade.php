@extends('layouts.alert')
@extends('layouts.app')
@section('content')
<div class="content-wrapper">
 <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line"><i class="fa fa-sign-in"></i> Sign In</h4>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-5">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                      <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" aria-describedby="basic-addon1" placeholder="Email/ Username" required autofocus>
                </div>
                    @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif<br>
                <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                    <input id="password" type="password" class="form-control" name="password" value="{{ old('email') }}" aria-describedby="basic-addon1" placeholder="Password" required>
                </div>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif<br>
                <div align="right">
                    <button class="btn btn-warning"><i class="fa fa-sign-in"></i> Login</button>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-1">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/dataTables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/js/dataTables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
@endsection