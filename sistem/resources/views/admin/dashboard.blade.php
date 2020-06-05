@extends('layouts.app-admin')
@section('content')
<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div cla ss="row">
    <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>
            Selamat datang di dashboard sistem presensi kepegawaian <strong>Universitas Harapan Bangsa.</strong> Sistem ini membantu merekap daftar hadir pegawai selama pemberlakukan <strong>Work From Home</strong> bagi dosen dan pegawai di <strong>Universitas Harapan Bangsa.</strong>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Presensi Hari Ini</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="small text-white stretched-link" href="#">{{$jml_masuk}}</i>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Cuti Hari Ini</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="small text-white stretched-link" href="#">{{$jml_ijin}}</i>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">Alfa Hari Ini</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="small text-white stretched-link" href="#">{{$jml_alfa}}</i>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Tidak Berangkat Hari Ini</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="small text-white stretched-link" href="#">{{$jml_tidak_berangkat}}</i>
            </div>
        </div>
    </div>
</div>
@endsection