@extends('layouts.alert')
@extends('layouts.app-admin')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">
      DATA GURU
    </h1>
    <ol class="breadcrumb">
      <li class="active">
        <i class="fa fa-clock-o"></i> Data Guru SD QU HANIFAH
      </li>
    </ol>
  </div>
</div>
<div class="panel panel-warning">
  <div class="panel panel-heading">
  </div>
  <div class="panel panel-body">
    <div class="table table-responsive">
      {!! Form::open(['url' => 'hapus-data/{id}']) !!}
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th width="5%"><input type="checkbox" name="select_all" id="select_all" value=""/></th>
            <th>No</th>
            <th>NIG</th>
            <th>Nama</th>
            <th>JK</th>
            <th>No. Handphone</th>
            <th>Alamat</th>
            <th>Rincian</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @foreach($data as $row)
          <tr>
            <td><label class="checkbox-inline"><input type="checkbox" name="checked_id[]" class="checkbox" value="{{$row->id}}"/></label></td>
            <td>{{$no}}</td>
            <td>{{$row->nig}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->jk}}</td>
            <td>{{$row->no_hp}}</td>
            <td>Jl. {{$row->jl}}, Rt. {{$row->rt}}, Rw. {{$row->rw}}, Dusun: {{$row->dusun}}, Desa: {{$row->desa}}, Kecamatan: {{$row->kecamatan}}</td>
            <td>
              <a href="{!! url('/'.$row->id.'/detail-biodata') !!}">
                <input type="button" class="btn btn-default" value="Detail">
              </a></td>
              <td>
                <a href="{!! url('/'.$row->id.'/edit-data') !!}">
                  <input type="button" class="btn btn-primary" value="Edit"></a>
                </td>
              </tr>
            </tr>
            <?php $no++; ?>
            @endforeach
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-2">
            <input type="submit" class="btn btn-danger btn-block" name="delete_submit" value="ARSIPKAN"/><br>
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