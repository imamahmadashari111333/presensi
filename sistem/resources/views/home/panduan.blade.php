@extends('layouts.app')
@section('content')
<div class="row">
    <div class="container">
        <div class="bs-callout bs-callout-warning">
          <h4>Panduan Presensi Online</h4>
          <p>
          Presensi online Universitas Harapan Bangsa merupakan aplikasi yang dibangun untuk melakukan monitoring kinerja pegawai selama pemberlakukan Perkuliahan Jarak Jauh</p>
            Adapun cara melakukan presensi online adalah sebagai berikut:
          <div class="row">
          <div class="col-md-7">
            <ul>
                <li><strong>Langkah Awal</strong></li>
                1.) Ketik alamat http://presensi.uhb.ac.id<br>
                2.) Pilih Menu Home<br>
                <li><strong>Presensi Berangkat</strong></li>
                <img src="{{asset('img/panduan/1.jpg')}}" width="100%"><br><br>
                <div class="alert alert-info" >
                1.) Pilih tombol <strong>Berangkat</strong><br>
                2.) Masukan NIK <br>
                3.) Klik tombol <strong>Simpan</strong>
                </div><br>
                <li><strong>Presensi Berangkat (Selanjutnya)</strong></li>
                <img src="{{asset('img/panduan/2.jpg')}}" width="100%"><br><br>
                <div class="alert alert-info" >
                Klik tombol <strong>simpan presensi</strong><br>
            </div>
                <li><strong>Presensi Pulang</strong></li>
                <img src="{{asset('img/panduan/3.jpg')}}" width="100%"><br><br>
                <div class="alert alert-info" >
                1.) Pilih tombol <strong>Pulang</strong><br>
                2.) Masukan NIK <br>
                3.) Klik tombol <strong>Simpan</strong>
                </div><br>
                <li><strong>Presensi Pulang (Selanjutnya)</strong></li>
                <img src="{{asset('img/panduan/4.jpg')}}" width="100%"><br><br>
                <div class="alert alert-info" >
                1.) Upload SWA Foto<br>
                2.) Isi Laporan Kerja Hari Ini <br>
                3.) Klik tombol <strong>Simpan Presensi</strong>
                </div>
            </ul>
          </div>
          </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/dataTables/jquery.dataTables.js')}}"></script>
@endsection
