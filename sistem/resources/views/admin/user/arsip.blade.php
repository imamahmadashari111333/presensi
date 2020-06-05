@extends('layouts.alert')
@extends('layouts.app-admin')
@section('content')
<div class="row hidden-print">
    <div class="col-lg-12">
        <h1 class="page-header">
            Arsip Pegawai
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-user"></i> Data Arsip pegawai
            </li>
        </ol>
    </div>
</div>
<div class="table table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>No</th>
                <th>NIG</th>
                <th>Nama</th>
                <th>JK</th>
                <th>HP</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>Unit</th>
                <th>Status Pegawai</th>
                <th>Alamat</th>
                <th>Tgl Arsip</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach($data as $row)
            <tr>
                <td>{{$no}}</td>
                <td>{{$row->nig}}</td>
                <td>{{$row->nama}}</td>
                <td>{{$row->jk}}</td>
                <td>{{$row->no_hp}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->level}}</td>
                <td>{{$row->unit}}</td>
                <td>{{$row->status_kepegawaian}}</td>
                <td>Jl. {{$row->jl}}, Rt. {{$row->rt}}, Rw. {{$row->rw}}, Dusun: {{$row->dusun}}, Desa: {{$row->desa}}, Kecamatan: {{$row->kecamatan}}</td>
                <td>{{$row->created_at}}</td>
            </tr>
            <?php $no++; ?>
            @endforeach
        </tbody>
    </table>
</div>
<script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/dataTables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/js/dataTables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script type="text/javascript">
   $(function() {
      $('#example1').dataTable();
  });
   $(document).ready(function(){
      $('#select_all').on('click',function(){
        if(this.checked){
          $('.checkbox').each(function(){
            this.checked = true;
        });
      }else{
       $('.checkbox').each(function(){
          this.checked = false;
      });
   }
});
  });
</script>
@endsection