@extends('layouts.app-admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Biodata
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-user"></i> Biodata diri
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-yellow">
            <div class="panel-heading">
            </div>
            <div class="panel-body">
            <div class="table table-responsive">
            <label class="label label-primary"><i class="fa fa-user"></i> Account</label><br><br>
            <table class="table">
                <tr>
                    <td width="1%">Username</td>
                    <td width="1%">:</td>
                    <td>{{Auth::user()->username}}</td>
                </tr>
                <tr>
                    <td width="1%">Email</td>
                    <td width="1%">:</td>
                    <td>{{Auth::user()->email}}</td>
                </tr>
            </table>
            </div>
            <div class="row">
            <div class="col-md-12 col-xs-12">
            <div class="table table-responsive">
            <label class="label label-success"><i class="fa fa-book"></i> Biodata Lengkap</label><br><br>
            <table class="table" >
                @foreach($data as $row)
                <tr>
                    <td width="10%">NIG</td>
                    <td width="1%">:</td>
                    <td width="25%">{{$row->nig}}</td>
                    <td width="10%">Telp</td>
                    <td width="1%">:</td>
                    <td width="25%">{{$row->no_telp}}</td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td>{{$row->nm_lengkap}}</td>
                    <td>HP</td>
                    <td>:</td>
                    <td>{{$row->no_hp}}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{$row->jk}}</td>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>JL. {{$row->jl}}, RT. {{$row->rt}}, RW. {{$row->rw}}, Dusun {{$row->dusun}}, Ds. {{$row->desa}}, Kec. {{$row->kecamatan}}</td>
                </tr>
                <tr>
                    <td>TTL</td>
                    <td>:</td>
                    <td>{{$row->tempat}}, {{$row->tgl_lahir}}</td>
                    <td>Kode Pos</td>
                    <td>:</td>
                    <td>{{$row->kode_pos}}</td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{$row->agama}}</td>
                    <td>Status Kepegawaian</td>
                    <td>:</td>
                    <td>{{$row->status_kepegawaian}}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>{{$row->status}}</td>
                    <td>NIY / NIGK</td>
                    <td>:</td>
                    <td>{{$row->niy_nigk}}</td>
                </tr>
                <tr>
                    <td>Kewarganegaraan</td>
                    <td>:</td>
                    <td>{{$row->kewarganegaraan}}</td>
                    <td>NUPTK</td>
                    <td>:</td>
                    <td>{{$row->nuptk}}</td>
                </tr>
                <tr>
                    <td>Nama Ibu</td>
                    <td>:</td>
                    <td>{{$row->nm_ibu}}</td>
                    <td>SK Pengangkatan</td>
                    <td>:</td>
                    <td>{{$row->sk_pengangkatan}}</td>
                </tr>
                <tr>
                    <td colspan="6" align="right"><br><br>
                    <a href="{!! url('/'.$row->id.'/edit-biodata') !!}">
                    <button class="btn btn-info"><i class="fa fa-edit"></i> Edit Biodata</button>
                    </a></td>
                </tr>
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
<script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
@endsection