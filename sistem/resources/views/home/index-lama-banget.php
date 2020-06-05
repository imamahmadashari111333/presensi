@extends('layouts.app')
@extends('layouts.alert')
@section('content')
<script src="http://maps.google.com/maps/api/js"></script>
@if($keterangan_kerja == 'WFO')
@elseif($keterangan_kerja == 'WFH')
@endif



<script>
    if(geo_position_js.init()){
        geo_position_js.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
    }
    else{
        div_isi=document.getElementById("div_isi");
        div_isi.innerHTML ="Tidak ada fungsi geolocation";
    }
    function success_callback(p)
    {
        latitude=p.coords.latitude;
        longitude=p.coords.longitude;
            // alert('lat='+p.coords.latitude.toFixed(2)+';lon='+p.coords.longitude.toFixed(2));
            if (    (p.coords.latitude <= "-7.0060933" || p.coords.latitude >= "-7.0381350")
             &&     (p.coords.longitude >= "110.46041129" || p.coords.longitude <= "110.4703750"))
            {
            // if ((p.coords.latitude >= "-7.0060933" || p.coords.latitude <= "-7.0381350") && (p.coords.longitude <= "110.46041129" || p.coords.longitude >= "110.4703750"))
            // {
                pesan='<ul class="nav nav-tabs"> <li class="active"><a data-toggle="tab" href="#menu1" ><button class="btn btn-primary btn-block"><i class="fa fa-plane"></i> Berangkat</button></a></li> <li><a data-toggle="tab" href="#menu2"><button class="btn btn-danger btn-block"><i class="fa fa-calendar"></i> Pulang</button></a></li> </ul> <div class="tab-content"> <div id="menu1" class="tab-pane fade in fade active"> <div class="bs-callout bs-callout-primary" style="background-color: white;"> <form action="{{ url("/presensi-berangkat") }}" action="GET"> <strong>Masukan NIG Anda</strong><hr style="border-top: 6px double #44b040;"> <input type="text" name="nig" class="form-control input-lg"><br> <div class="row"> <div class="col-md-4 col-md-offset-8"> <button class="btn btn-warning btn-block"><i class="fa fa-save"></i> Simpan</button> </div> </div> </form> </div> </div> <div id="menu2" class="tab-pane fade"> <div class="bs-callout bs-callout-danger" style="background-color: white;"> <form action="{{ url("/presensi-pulang") }}" action="GET"> <strong>Masukan NIG Anda</strong><hr style="border-top: 6px double #44b040;"> <input type="text" name="nig" class="form-control input-lg" ><br> <div class="row"> <div class="col-md-4 col-md-offset-8"> <button class="btn btn-warning btn-block"><i class="fa fa-save"></i> Simpan</button> </div> </div> </form> </div>';
            } else {
                pesan = "Anda diluar jangkauan ! <div id='mapcanvas'></div>";
            }
            div_isi=document.getElementById("div_isi");
            div_isi.innerHTML =pesan;
        }
        function error_callback(p)
        {
            div_isi=document.getElementById("div_isi");
            div_isi.innerHTML ='error='+p.message;
        } 
    </script> 
    <html>
    <head>
        <meta charset="utf-8">
        <title>Jam Digital</title>
        <script type="text/javascript">
            window.setTimeout("waktu()",1000);
            function waktu() {
                var tanggal = new Date();
                setTimeout("waktu()",1000);
                document.getElementById("jam").innerHTML = tanggal.getHours();
                document.getElementById("menit").innerHTML = tanggal.getMinutes();
                document.getElementById("detik").innerHTML = tanggal.getSeconds();
            }
        </script>
    </head>
    <body onLoad="waktu()">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-md-offset-10">
                    <div class="alert alert-info">
                        <center>
                        <div id="jam-digital" style="color:black;">
                            <div><span id="jam"></span>:<span id="menit"></span>:<span id="detik"></span></div>
                        </div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-12"> 
                <div class="col-md-4 col-md-offset-4">
                    <div id="div_isi"></div>
                </div>
            </div>
            </div>
        </div>
        <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.js')}}"></script>
        @endsection