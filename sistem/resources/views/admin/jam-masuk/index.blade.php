@extends('layouts.alert')
@extends('layouts.app-admin')
@section('content')
<h1 class="mt-4">Jam Kerja</h1>
<ol class="breadcrumb mb-4">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
   <i class="fa fa-plus"></i> Input jam masuk
 </button>
</ol>
<div class="panel panel-info">
  <div class="panel-body">
   {!! Form::open(['url' => 'hapus-jam/{id}']) !!}
   <div class="table table-responsive">
    <table class="table table-bordered table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th width="2%" class="text-center"><input type="checkbox" name="select_all" id="select_all" value=""/></th>
          <script type="text/javascript">
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
          <th class="text-center">No</th>
          <th class="text-center">NIK</th>
          <th class="text-center">Nama</th>
          <th class="text-center">Senin - Jumat</th>
          <th class="text-center">Sabtu</th>
          <th class="text-center">Minggu</th>
          <th class="text-center">Ket</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        @foreach($data as $row)
        <tr>
          <td align="center"><label class="checkbox-inline"><input type="checkbox" name="checked_id[]" class="checkbox" value="{{$row->id}}"/></label></td>
          <td align="center">{{$no}}</td>
          <td align="center">{{$row->password_presensi}}</td>
          <td>{{$row->name}}</td>
          <td align="center">{{$row->jammasuk}}</td>
          <td align="center">{{$row->sabtu}}</td>
          <td align="center">{{$row->minggu}}</td>
          <td align="center">
            @if($row->keterangan == 'WFO')
            <strong style="color: blue;">{{$row->keterangan}}</strong>
            @elseif($row->keterangan == 'WFH')
            <strong style="color: green;">{{$row->keterangan}}</strong>
          @endif</td>
          <td align="center">
            <input type="button" title="Edit Jam Masuk" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#yourModal1{{$row->id}}" value="Edit">
          </td>
        </tr>
        <?php $no++; ?>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header"><strong>ALL ACTION SELECTION</strong></div>
      <div class="card-body">
        <div class="table table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th class="text-center" width="15%" rowspan="2">Aksi Hapus</th>
                <th class="text-center" colspan="2">Aksi Edit</th>
              </tr>
              <tr>
                <th class="text-center" width="44%">Jam Masuk</th>
                <th class="text-center" width="41%">Keterangan Kerja</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td align="center"><input type="submit" class="btn btn-danger btn-block" name="delete_submit" value="HAPUS"/></td>
                <td align="center">
                  <div class="form-group row">
                    <label for="jammasuk" class="col-md-4 col-form-label text-md-right">{{ __('Senin s/d Jumat *') }}</label>
                    <div class="col-md-7">
                      <input id="jammasuk" type="text" class="form-control{{ $errors->has('jammasuk') ? ' is-invalid' : '' }}" name="jammasuk" value="00:00:00">

                      @if ($errors->has('jammasuk'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('jammasuk') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="sabtu" class="col-md-4 col-form-label text-md-right">{{ __('Sabtu') }}</label>
                    <div class="col-md-7">
                      <input id="sabtu" type="text" class="form-control{{ $errors->has('sabtu') ? ' is-invalid' : '' }}" name="sabtu" value="00:00:00">

                      @if ($errors->has('sabtu'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('sabtu') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="minggu" class="col-md-4 col-form-label text-md-right">{{ __('Minggu') }}</label>
                    <div class="col-md-7">
                      <input id="minggu" type="text" class="form-control{{ $errors->has('minggu') ? ' is-invalid' : '' }}" name="minggu" value="00:00:00">

                      @if ($errors->has('minggu'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('minggu') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="minggu" class="col-md-4 col-form-label text-md-right"></label>
                    <div class="col-md-5">
                      <button class="btn btn-primary btn-block" name="update_jammasuk">UPDATE</button>
                    </div>
                  </div>
                </td>
                <td align="center">
                  <div class="form-group row">
                    <label for="keterangan" class="col-md-4 col-form-label text-md-right">{{ __('keterangan *') }}</label>
                    <div class="col-md-7">
                      <select id="keterangan" type="text" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" name="keterangan" value="{{ old('keterangan')}}">
                        <option value="">- Pilih -</option>
                        <option>WFO</option>
                        <option>WFH</option>
                      </select>
                      @if ($errors->has('keterangan'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('keterangan') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="minggu" class="col-md-4 col-form-label text-md-right"></label>
                    <div class="col-md-5">
                      <button class="btn btn-primary btn-block" name="update_keterangan">UPDATE</button>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
{{Form::close()}}
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong> Input Jam Masuk</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        {!! Form::open(['url' => 'simpan-jam']) !!}
        <div class="form-group row">
          <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama *') }}</label>
          <div class="col-md-8">
            <select name="id_user" class="form-control" data-live-search="true">
              <option value="" data-tokens="mustard">- Pilih -</option>
              @foreach($nama as $row)
              <option value="{{$row->id}}" data-tokens="mustard">{{$row->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="jammasuk" class="col-md-4 col-form-label text-md-right">{{ __('Senin s/d Jumat *') }}</label>
          <div class="col-md-5">
            <input id="jammasuk" type="text" class="form-control{{ $errors->has('jammasuk') ? ' is-invalid' : '' }}" name="jammasuk" value="00:00:00" required autofocus>

            @if ($errors->has('jammasuk'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('jammasuk') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="sabtu" class="col-md-4 col-form-label text-md-right">{{ __('Sabtu') }}</label>
          <div class="col-md-5">
            <input id="sabtu" type="text" class="form-control{{ $errors->has('sabtu') ? ' is-invalid' : '' }}" name="sabtu" value="00:00:00" autofocus>

            @if ($errors->has('sabtu'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('sabtu') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="minggu" class="col-md-4 col-form-label text-md-right">{{ __('Minggu') }}</label>
          <div class="col-md-5">
            <input id="minggu" type="text" class="form-control{{ $errors->has('minggu') ? ' is-invalid' : '' }}" name="minggu" value="00:00:00" autofocus>

            @if ($errors->has('minggu'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('minggu') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="keterangan" class="col-md-4 col-form-label text-md-right">{{ __('keterangan *') }}</label>
          <div class="col-md-5">
            <select id="keterangan" type="text" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" name="keterangan" value="{{ old('keterangan')}}" required autofocus>
              <option value="">- Pilih -</option>
              <option>WFO</option>
              <option>WFH</option>
            </select>
            @if ($errors->has('keterangan'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('keterangan') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="minggu" class="col-md-4 col-form-label text-md-right"></label>
          <div class="col-md-5">
            <button class="btn btn-primary">Simpan</button>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@foreach ($data as $row)    
{!! Form::model($row, ['url' => ['/update-jam', $row->id]]) !!}
<div class="modal fade" id="yourModal1{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Edit Jam Masuk
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="jammasuk" class="col-md-4 col-form-label text-md-right">{{ __('Senin s/d Jumat *') }}</label>
          <div class="col-md-5">
            <input id="jammasuk" type="text" class="form-control{{ $errors->has('jammasuk') ? ' is-invalid' : '' }}" name="jammasuk" value="{{$row->jammasuk}}" required autofocus>

            @if ($errors->has('jammasuk'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('jammasuk') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="sabtu" class="col-md-4 col-form-label text-md-right">{{ __('Sabtu') }}</label>
          <div class="col-md-5">
            <input id="sabtu" type="text" class="form-control{{ $errors->has('sabtu') ? ' is-invalid' : '' }}" name="sabtu" value="{{$row->sabtu}}" autofocus>

            @if ($errors->has('sabtu'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('sabtu') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="minggu" class="col-md-4 col-form-label text-md-right">{{ __('Minggu') }}</label>
          <div class="col-md-5">
            <input id="minggu" type="text" class="form-control{{ $errors->has('minggu') ? ' is-invalid' : '' }}" name="minggu" value="{{$row->minggu}}" autofocus>

            @if ($errors->has('minggu'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('minggu') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="keterangan" class="col-md-4 col-form-label text-md-right">{{ __('keterangan *') }}</label>
          <div class="col-md-5">
            <select id="keterangan" type="text" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" name="keterangan" value="{{ old('keterangan')}}" required autofocus>
              <option>{{$row->keterangan}}</option>
              <option>WFO</option>
              <option>WFH</option>
            </select>
            @if ($errors->has('keterangan'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('keterangan') }}</strong>
            </span>
            @endif
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
{!!Form::close()!!}
@endforeach

@endsection