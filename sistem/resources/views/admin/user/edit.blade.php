@extends('layouts.app-admin')
@extends('layouts.alert')
@section('content')
<h1 class="mt-4">Edit Biodata</h1>
<ol class="breadcrumb mb-4">
  Edit Biodata diri
</ol>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-yellow">
            <div class="panel-heading">
            </div>
            {!! Form::model($user, ['files'=>true, 'url' => ['/update-data', $user->id]]) !!}
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="table table-responsive">
                            <table class="table">
                                <tr>
                                    <td width="1%">Nama</td>
                                    <td width="1%">:</td>
                                    <td>
                                        <div class="col-md-5">
                                            <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="1%">Email</td>
                                    <td width="1%">:</td>
                                    <td>
                                        <div class="col-md-5">
                                            <input type="text" name="email" class="form-control" value="{{$user->email}}"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="1%">NIK</td>
                                        <td width="1%">:</td>
                                        <td>
                                            <div class="col-md-5">
                                                <input type="text" name="password_presensi" class="form-control" value="{{$user->password_presensi}}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="1%">Username</td>
                                        <td width="1%">:</td>
                                        <td>
                                            <div class="col-md-5">
                                                <input type="text" name="username" class="form-control" value="{{$user->username}}">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="1%">Password</td>
                                        <td width="1%">:</td>
                                        <td>
                                            <div class="col-md-5">
                                                <input type="text" name="password" class="form-control" value="{{$user->password_view}}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="1%"></td>
                                        <td width="1%"></td>
                                        <td >
                                            <div class="col-md-5">
                                                <button class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection