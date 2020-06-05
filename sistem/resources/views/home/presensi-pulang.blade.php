@extends('layouts.app')
@extends('layouts.alert')
@section('content')
<script>
  if(geo_position_js.init()){
    geo_position_js.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
  }
  else{
    lokasi=document.getElementById("lokasi");
  }

  function success_callback(p)
  {
    latitude=p.coords.latitude ;
    longitude=p.coords.longitude;
    pesan=+latitude+','+longitude;
    pesan = pesan + "";

    lat=+latitude;
    lat = lat + "";
    document.getElementById("Lokasi").value = pesan;
          }

          function error_callback(p)
          {
            lokasi=document.getElementById("lokasi");
          }    

        </script>
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="row">
              <div class="col-md-12">
               <div class="bs-callout bs-callout-default" style="background-color: white;">

                 @if (count($data) > 0)
                 @foreach($data as $row)
                 <center>
                   <input type="hidden" name="id_user" value="{{ $row-> id}}">
                   <h4><strong>{{$row->name}}</strong></h4><hr>
                 </center>
                 {!! Form::open(['files'=>true, 'url' => ['/simpan-presensi-pulang', $row->id]]) !!}
                 @endforeach
                 <input type="hidden" name="lokasi" id="Lokasi">
                <center>
                 <a href="{{url('/')}}">
                   <input type="button" value="Kembali" class="btn btn-default"></a>
                   <button class="btn btn-danger" onclick="success_callback()" ><i class="fa fa-save"></i> Simpan Presensi</button>
                 </center>
                 {!! Form::close() !!}
                 @else 
                 <br>
                 <div class="alert alert-danger" role="alert">Data tidak ditemukan</div>
                 @endif
               </div>
             </div>
           </div>
         </div>
       </div>
       <script type="text/javascript">
        var readFoto= function(event) {
          var input = event.target;
          var reader = new FileReader();
          reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('output');
            output.src = dataURL;
          };
          reader.readAsDataURL(input.files[0]);
        };
      </script>
      <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>
      <script src="{{asset('assets/js/bootstrap.js')}}"></script>
      @endsection
