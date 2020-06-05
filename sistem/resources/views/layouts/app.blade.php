<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{asset('img/icon/logo.png')}}">
    <title>Presensi Online Universitas Harapan Bangsa</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/js/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css')}}">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://maps.google.com/maps/api/js"></script>
    <script src="{{ asset('assets/js/geo-min.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
    <style type="text/css">
        .preloader {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: 9999;
          background-color: #fff;
      }
      .preloader .loading {
          position: absolute;
          left: 50%;
          top: 50%;
          transform: translate(-50%,-50%);
          font: 14px arial;
      }
  </style>
  <script>
    $(document).ready(function(){
      $(".preloader").fadeOut();
  })
</script>
</head>
<body>
    <div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}">
                    <h2 style="font-family: impact; color: #428bca; margin-top: -0px;">Presensi Pegawai</h2>
                </a>
                <h5>UNIVERSITAS HARAPAN BANGSA</h5>
            </div>
            <div class="right-div">
                <a href="{{url('log-in')}}" class="btn btn-info pull-right"><i class="fa fa-sign-in"></i> Login</a>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <strong>
                                <i class="fa fa-sign-in" aria-hidden="true"></i> Log In</strong>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}

                                    <div class="input-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                      <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                      <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" aria-describedby="basic-addon1" placeholder="Username" required autofocus>
                                      @if ($errors->has('username'))
                                      <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div><br>
                                <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" aria-describedby="basic-addon1" placeholder="Email" required>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-11 col-md-offset-1">
                                        <button type="submit" class="btn btn-warning">
                                            Login
                                        </button>

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
    </div>
    <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="{{url('/')}}" class="menu-top-active"><i class="fa fa-home"></i> HOME</a></li>
                            <li><a href="{{url('kehadiran-hari-ini')}}"><i class="fa fa-calendar"></i> PRESENSI</a></li>
                            <li><a href="{{url('data-pegawai')}}"><i class="fa fa-list"></i> DATA PEGAWAI</a></li>
                            <li><a href="{{url('jenis-cuti')}}"><i class="fa fa-share" aria-hidden="true"></i> JENIS CUTI</a></li>
                            <li><a href="{{url('panduan')}}"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> PANDUAN</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="app">
        <div class="preloader">
          <div class="loading">
            <img src="{{asset('img/poi.gif') }}" width="80">
            <p>Harap Tunggu</p>
        </div>
    </div>
    @yield('content')
</div>
<section class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                &copy; Copyright © 2020 Universitas Harapan Bangsa || All Rights Reserved
            </div>
        </div>
    </div>
</section>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script>
 $(function () {
    CKEDITOR.replace('ckeditor');
});
</script>
</body>
</html>
