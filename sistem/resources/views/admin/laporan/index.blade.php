@extends('layouts.alert')
@extends('layouts.app-admin')
@section('content')
<h1 class="mt-4">Presensi Kerja</h1>
<ol class="breadcrumb mb-4">
  Data presensi 2 Bulan Terakhir
</ol>
<div class="row">
    <div class="col-lg-12">
     <div class="panel panel-default">
        <div class="table table-responsive">
            <table class="table table-bordered table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Hari</th>
                    <th class="text-center">Presensi</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Device</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach($data as $row)
                @if($row->hari == 'Saturday')
                @if($row->sabtu < $row->berangkat)
                <tr class="danger red">
                    <td align="center">{{$no}}</td>
                    <td>{{$row->name}}</td>
                    <td align="center">@if($row->hari == 'Sunday')
                        Minggu
                        @elseif($row->hari == 'Monday')
                        Senin
                        @elseif($row->hari == 'Tuesday')
                        Selasa
                        @elseif($row->hari == 'Wednesday')
                        Rabu
                        @elseif($row->hari == 'Thursday')
                        Kamis
                        @elseif($row->hari == 'Friday')
                        Jumat
                        @elseif($row->hari == 'Saturday')
                        Sabtu
                        @else
                    @endif </td>
                    <td align="center"><strong>Berangkat</strong>: {{$row->berangkat}}<br><strong>Pulang</strong>: {{$row->pulang}}</td>
                    <td align="center">{{$row->tanggal}}</td>
                    <td align="center"><strong>Lokasi Berangkat</strong>: <a href="https://www.google.com/search?q={{$row->lokasi_berangkat}}&oq={{$row->lokasi_berangkat}}" target='_blank'>{{$row->lokasi_berangkat}}</a><br><strong>Lokasi Pulang</strong>: <a href="https://www.google.com/search?q={{$row->lokasi_pulang}}&oq={{$row->lokasi_pulang}}" target='_blank'>{{$row->lokasi_pulang}}</a></td>
                    <td align="center">{{$row->hardware}}</td>
                    
                    <td align="center">
                        <input type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#yourModal1{{$row->id}}" value="Edit">
                    </td>
                </tr>
                @else
                <tr>
                    <td align="center">{{$no}}</td>
                    <td>{{$row->name}}</td>
                    <td align="center">@if($row->hari == 'Sunday')
                        Minggu
                        @elseif($row->hari == 'Monday')
                        Senin
                        @elseif($row->hari == 'Tuesday')
                        Selasa
                        @elseif($row->hari == 'Wednesday')
                        Rabu
                        @elseif($row->hari == 'Thursday')
                        Kamis
                        @elseif($row->hari == 'Friday')
                        Jumat
                        @elseif($row->hari == 'Saturday')
                        Sabtu
                        @else
                    @endif </td>
                    <td align="center"><strong>Berangkat</strong>: {{$row->berangkat}}<br><strong>Pulang</strong>: {{$row->pulang}}</td>
                    <td align="center">{{$row->tanggal}}</td>
                    <td align="center"><strong>Lokasi Berangkat</strong>: <a href="https://www.google.com/search?q={{$row->lokasi_berangkat}}&oq={{$row->lokasi_berangkat}}" target='_blank'>{{$row->lokasi_berangkat}}</a><br><strong>Lokasi Pulang</strong>: <a href="https://www.google.com/search?q={{$row->lokasi_pulang}}&oq={{$row->lokasi_pulang}}" target='_blank'>{{$row->lokasi_pulang}}</a></td>
                    <td align="center">{{$row->hardware}}</td>
                    
                    <td align="center">
                        <input type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#yourModal1{{$row->id}}" value="Edit">
                    </td>
                </tr>
                @endif
                @elseif($row->hari == 'Sunday')
                @if($row->minggu < $row->berangkat)
                <tr class="danger red">
                    <td align="center">{{$no}}</td>
                    <td>{{$row->name}}</td>
                    <td align="center">@if($row->hari == 'Sunday')
                        Minggu
                        @elseif($row->hari == 'Monday')
                        Senin
                        @elseif($row->hari == 'Tuesday')
                        Selasa
                        @elseif($row->hari == 'Wednesday')
                        Rabu
                        @elseif($row->hari == 'Thursday')
                        Kamis
                        @elseif($row->hari == 'Friday')
                        Jumat
                        @elseif($row->hari == 'Saturday')
                        Sabtu
                        @else
                    @endif </td>
                    <td align="center"><strong>Berangkat</strong>: {{$row->berangkat}}<br><strong>Pulang</strong>: {{$row->pulang}}</td>
                    <td align="center">{{$row->tanggal}}</td>
                    <td align="center"><strong>Lokasi Berangkat</strong>: <a href="https://www.google.com/search?q={{$row->lokasi_berangkat}}&oq={{$row->lokasi_berangkat}}" target='_blank'>{{$row->lokasi_berangkat}}</a><br><strong>Lokasi Pulang</strong>: <a href="https://www.google.com/search?q={{$row->lokasi_pulang}}&oq={{$row->lokasi_pulang}}" target='_blank'>{{$row->lokasi_pulang}}</a></td>
                    <td align="center">{{$row->hardware}}</td>
                    
                    <td align="center">
                        <input type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#yourModal1{{$row->id}}" value="Edit">
                    </td>
                </tr>
                @else
                <tr>
                    <td align="center">{{$no}}</td>
                    <td>{{$row->name}}</td>
                    <td align="center">@if($row->hari == 'Sunday')
                        Minggu
                        @elseif($row->hari == 'Monday')
                        Senin
                        @elseif($row->hari == 'Tuesday')
                        Selasa
                        @elseif($row->hari == 'Wednesday')
                        Rabu
                        @elseif($row->hari == 'Thursday')
                        Kamis
                        @elseif($row->hari == 'Friday')
                        Jumat
                        @elseif($row->hari == 'Saturday')
                        Sabtu
                        @else
                    @endif </td>
                    <td align="center"><strong>Berangkat</strong>: {{$row->berangkat}}<br><strong>Pulang</strong>: {{$row->pulang}}</td>
                    <td align="center">{{$row->tanggal}}</td>
                    <td align="center"><strong>Lokasi Berangkat</strong>: <a href="https://www.google.com/search?q={{$row->lokasi_berangkat}}&oq={{$row->lokasi_berangkat}}" target='_blank'>{{$row->lokasi_berangkat}}</a><br><strong>Lokasi Pulang</strong>: <a href="https://www.google.com/search?q={{$row->lokasi_pulang}}&oq={{$row->lokasi_pulang}}" target='_blank'>{{$row->lokasi_pulang}}</a></td>
                    <td align="center">{{$row->hardware}}</td>
                    
                    <td align="center">
                        <input type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#yourModal1{{$row->id}}" value="Edit">
                    </td>
                </tr>
                @endif
                @else
                @if($row->jammasuk < $row->berangkat)
                <tr class="danger red">
                    <td align="center">{{$no}}</td>
                    <td>{{$row->name}}</td>
                    <td align="center">@if($row->hari == 'Sunday')
                        Minggu
                        @elseif($row->hari == 'Monday')
                        Senin
                        @elseif($row->hari == 'Tuesday')
                        Selasa
                        @elseif($row->hari == 'Wednesday')
                        Rabu
                        @elseif($row->hari == 'Thursday')
                        Kamis
                        @elseif($row->hari == 'Friday')
                        Jumat
                        @elseif($row->hari == 'Saturday')
                        Sabtu
                        @else
                    @endif </td>
                    <td align="center"><strong>Berangkat</strong>: {{$row->berangkat}}<br><strong>Pulang</strong>: {{$row->pulang}}</td>
                    <td align="center">{{$row->tanggal}}</td>
                    <td align="center"><strong>Lokasi Berangkat</strong>: <a href="https://www.google.com/search?q={{$row->lokasi_berangkat}}&oq={{$row->lokasi_berangkat}}" target='_blank'>{{$row->lokasi_berangkat}}</a><br><strong>Lokasi Pulang</strong>: <a href="https://www.google.com/search?q={{$row->lokasi_pulang}}&oq={{$row->lokasi_pulang}}" target='_blank'>{{$row->lokasi_pulang}}</a></td>
                    <td align="center">{{$row->hardware}}</td>
                    
                    <td align="center">
                        <input type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#yourModal1{{$row->id}}" value="Edit">
                    </td>
                </tr>
                @else
                <tr>
                    <td align="center">{{$no}}</td>
                    <td>{{$row->name}}</td>
                    <td align="center">@if($row->hari == 'Sunday')
                        Minggu
                        @elseif($row->hari == 'Monday')
                        Senin
                        @elseif($row->hari == 'Tuesday')
                        Selasa
                        @elseif($row->hari == 'Wednesday')
                        Rabu
                        @elseif($row->hari == 'Thursday')
                        Kamis
                        @elseif($row->hari == 'Friday')
                        Jumat
                        @elseif($row->hari == 'Saturday')
                        Sabtu
                        @else
                    @endif </td>
                    <td align="center"><strong>Berangkat</strong>: {{$row->berangkat}}<br><strong>Pulang</strong>: {{$row->pulang}}</td>
                    <td align="center">{{$row->tanggal}}</td>
                    <td align="center"><strong>Lokasi Berangkat</strong>: <a href="https://www.google.com/search?q={{$row->lokasi_berangkat}}&oq={{$row->lokasi_berangkat}}" target='_blank'>{{$row->lokasi_berangkat}}</a><br><strong>Lokasi Pulang</strong>: <a href="https://www.google.com/search?q={{$row->lokasi_pulang}}&oq={{$row->lokasi_pulang}}" target='_blank'>{{$row->lokasi_pulang}}</a></td>
                    <td align="center">{{$row->hardware}}</td>
                    
                    <td align="center">
                        <input type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#yourModal1{{$row->id}}" value="Edit">
                    </td>
                </tr>
                @endif
                @endif
                <?php $no++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
    @foreach ($data as $row)    
    {!! Form::model($row, ['url' => ['/update-presensi', $row->id]]) !!}
    <div class="modal fade" id="yourModal1{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              Edit Presensi
          </div>
          <div class="modal-body">
              <strong>Berangkat:</strong>
              <input type="text" name="berangkat" value="{{$row->berangkat}}" class="form-control"><br>
              <strong>Pulang:</strong>
              <input type="text" name="pulang" value="{{$row->pulang}}" class="form-control"><br>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button class="btn btn-primary">Update</button>
          </div>
      </div>
  </div>
</div>
{!!Form::close()!!}
@endforeach

@foreach ($data as $row)    
    <div class="modal fade" id="yourModal2{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              Laporan Kerja
          </div>
          <div class="modal-body">
              {!!$row->laporan!!}
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
@endforeach

</div>
</div>
</div>
</div>
</div>
</div>
@endsection