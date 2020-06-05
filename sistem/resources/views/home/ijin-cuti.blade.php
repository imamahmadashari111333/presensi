@extends('layouts.alert')
@extends('layouts.app')
@section('content')
<div class="content-wrapper">
 <div class="container">
  <div class="row pad-botm">
    <div class="col-md-12">
      <h4 class="header-line"><i class="fa fa-pencil"></i> Input Ijin/ Cuti</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">

          @if ($jam < '08:00:00')
          <div class="alert alert-danger"><strong>*Input ijin/ cuti pegawai baru bisa dilakukan diatas jam 08.00</strong></div>
          @else
          <div class="alert alert-info"><strong>*Input ijin/ cuti pegawai</strong></div>
          <div class="row">
          <div class="col-md-6">
            {!! Form::open(['url' => 'simpan-ijin-pegawai']) !!}
            <div class="col-md-4 col-sm-4 col-xs-4">
              <strong>NIG*</strong>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8">
              <input type="text" name="nig" class="form-control" placeholder="Masukan NIG"><br>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
              <strong>Tanggal*</strong>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-5">
              <input type="text" name="tanggal" class="form-control" value="{{$tanggal}}"><br>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
              <strong>Keterangan*</strong>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
              <select name="keterangan" class="form-control" data-live-search="true">
              <option>- Keterangan-</option>
              <option value="2" data-tokens="mustard">Ijin</option>
              <option value="3" data-tokens="mustard">Alfa</option>
            </select><br>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
              <strong>Keterangan Detail</strong>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8">
            <textarea type="text" name="keterangan_rinci" class="form-control"></textarea><br>
            </div>
          </div>
        </div>
            <div class="row">
              <div class="col-md-12 col-md-offset-2">
            <button class="btn btn-primary">Simpan</button></div>
            {!! Form::close() !!}
          </div>
          @endif<br><br>
          <div class="row">
            <div class="col-md-12">
          <div class="table table-responsive">

    <table class="table table-striped table-bordered table-hover" id="dataTables-example">

      <thead>

        <tr>

          <th>No</th>

          <th>Nama</th>

          <th>Keterangan</th>
          <th>Keterangan Detail</th>
          <th>Tanggal</th>

        </tr>

      </thead>

      <tbody>

        <?php $no = 1; ?>

        @foreach($data as $row)

        <tr>

          <td>{{$no}}</td>

          <td>{{$row->name}}</td>

          <td>
            @if($row->keterangan == 1)
            Ijin
            @elseif($row->keterangan == 2)
            Alpa
            @elseif($row->keterangan == 3)
            Cuti
            @endif</td>
          <td>{{$row->keterangan_rinci}}</td>
          <td>{{$row->tanggal}}</td>

        </tr>

        <?php $no++; ?>

        @endforeach

      </tbody>

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
  <script src="{{asset('assets/js/dataTables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('assets/js/dataTables/dataTables.bootstrap.js')}}"></script>
  <script src="{{asset('assets/js/custom.js')}}"></script>

  @endsection