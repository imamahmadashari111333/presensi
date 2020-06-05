@extends('layouts.app-admin')
@section('content')
<h1 class="mt-4">Detail Biodata</h1>
<ol class="breadcrumb mb-4">
  Detail Biodata diri
</ol>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading hidden-print">
            </div>
            <div class="panel-body">
            <div class="row">
            <div class="col-md-12 col-xs-12">
            <table class="table" >
                @foreach($data as $row)
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td>{{$row->name}}</td>
                </tr>
                <tr>
                    <td width="10%">NIK</td>
                    <td width="1%">:</td>
                    <td width="25%">{{$row->password_presensi}}</td>
                </tr>
                <tr>
                    <td width="10%">Email</td>
                    <td width="1%">:</td>
                    <td width="25%">{{$row->email}}</td>
                </tr>
                <tr>
                    <td width="10%">Username</td>
                    <td width="1%">:</td>
                    <td width="25%">{{$row->username}}</td>
                </tr>
                <tr>
                    <td width="10%">Password</td>
                    <td width="1%">:</td>
                    <td width="25%">{{$row->password_view}}</td>
                </tr>
                <tr>
                @endforeach
            </table>
            </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection