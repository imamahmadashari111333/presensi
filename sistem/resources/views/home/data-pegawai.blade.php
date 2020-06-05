@extends('layouts.alert')

@extends('layouts.app')

@section('content')

<!-- LOGO HEADER END-->

<!-- MENU SECTION END-->

<div class="content-wrapper">

   <div class="container">

    <div class="row pad-botm">

        <div class="col-md-12">

            <h4 class="header-line"><i class="fa fa-list"></i> Data Pegawai</h4>

        </div>

    </div>

    <div class="row">

        <div class="col-md-12">

            <!-- Advanced Tables -->

            <div class="panel panel-default">

                <div class="panel-heading">

                </div>

                <div class="panel-body">

                <div class="alert alert-info">

                <strong>*Untuk melihat dan mengedit data lengkap anda silahkan login ke sistem</strong></div>

                    <div class="table table-responsive">

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                            <thead>

                                <tr>

                                    <th class="text-center">No</th>
                                    <th class="text-center">NIK</th>
                                    <th class="text-center">Nama</th>
                                </tr>

                            </thead>

                            <tbody>

                            <?php $no = 1; ?>

                            @foreach($data as $row)

                                <tr>

                                    <td align="center">{{$no}}</td>
                                    <td align="center">{{$row->password_presensi}}</td>
                                    <td>{{$row->name}}</td>
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

<script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>

<script src="{{asset('assets/js/bootstrap.js')}}"></script>

<script src="{{asset('assets/js/dataTables/jquery.dataTables.js')}}"></script>

<script src="{{asset('assets/js/dataTables/dataTables.bootstrap.js')}}"></script>

<script src="{{asset('assets/js/custom.js')}}"></script>

@endsection