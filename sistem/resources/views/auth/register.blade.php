@extends('layouts.alert')
@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line"><i class="fa fa-list"></i> Register</h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                {!! Form::open(['files'=>true, 'url' => ['/simpan-register']]) !!}
                <div class="panel-body">
                    <div class="table table-responsive">
                        <label class="label label-primary"><i class="fa fa-user"></i> Account</label><br><br>
                        <table class="table">
                            <tr>
                                <td width="1%">Foto</td>
                                <td width="1%">:</td>
                                <td>
                                    <div class="col-md-3">
                                        <input type="file" name="foto" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="1%">Username</td>
                                <td width="1%">:</td>
                                <td>
                                    <div class="col-md-5">
                                        <input type="text" name="username" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="1%">Email</td>
                                <td width="1%">:</td>
                                <td>
                                    <div class="col-md-5">
                                        <input type="email" name="email" class="form-control"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="1%">Password</td>
                                    <td width="1%">:</td>
                                    <td>
                                        <div class="col-md-5">
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td width="1%">Password Presensi</td>
                                    <td width="1%">:</td>
                                    <td>
                                        <div class="col-md-5">
                                            <input type="password" name="password_presensi" class="form-control">
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>
                                    <input type="hidden" name="nig" class="form-control">
                                    <td width="1%">Level</td>
                                    <td width="1%">:</td>
                                    <td>
                                        <div class="col-md-3">
                                            <select class="form-control" name="level">
                                                <option>- Pilih -</option>
                                                <option>Kepala Unit</option>
                                                <option>Operator</option>
                                                <option>Pegawai</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="1%">Unit</td>
                                    <td width="1%">:</td>
                                    <td>
                                        <div class="col-md-3">
                                            <select class="form-control" name="unit">
                                                <option>- Pilih -</option>
                                                <option>Daycare</option>
                                                <option>KB TK KHALIFAH 25</option>
                                                <option>KB TK KHALIFAH 50</option>
                                                <option>SD QU HANIFAH</option>
                                                <option>Graha Sedekah</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="table table-responsive">
                                    <label class="label label-success"><i class="fa fa-book"></i> Biodata Lengkap</label><br><br>
                                    <table class="table" >
                                        <tr>
                                            <td width="10%">NIG</td>
                                            <td width="1%">:</td>
                                            <td width="25%">
                                                <input type="text" name="nig" class="form-control" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="10%">NIK</td>
                                            <td width="1%">:</td>
                                            <td width="25%">
                                                <input type="text" name="nik" class="form-control" >
                                            </td>
                                            <td width="10%">Telp</td>
                                            <td width="1%">:</td>
                                            <td width="25%">
                                                <input type="number" name="no_telp" value="0" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="nm_lengkap" class="form-control">
                                            </td>
                                            <td>HP</td>
                                            <td>:</td>
                                            <td>
                                                <input type="number" name="no_hp" value="0" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>:</td>
                                            <td>
                                                <select class="form-control" name="jk">
                                                    <option>- Pilih -</option>
                                                    <option>Laki - laki</option>
                                                    <option>Perempuan</option>
                                                </select>
                                            </td>
                                            <td>Kode Pos</td>
                                            <td>:</td>
                                            <td>
                                                <input type="number" name="kode_pos" value="0" class="form-control" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>TTL</td>
                                            <td>:</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Tempat: 
                                                        <input type="text" name="tempat" class="form-control">
                                                    </div>
                                                    <div class="col-md-6"> 
                                                        <br>Tanggal Lahir:
                                                        <input type="date" name="tgl_lahir" class="form-control" >
                                                    </div>
                                                </div></td>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            JL:
                                                            <input type="text" name="jl" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            Rt:
                                                            <input type="text" name="rt" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            Rw:
                                                            <input type="text" name="rw" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <br>Dusun:
                                                            <input type="text" name="dusun" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <br>Desa:
                                                            <input type="text" name="desa" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <br>Kecamatan:
                                                            <input type="text" name="kecamatan" class="form-control">
                                                        </div>
                                                    </div></td>
                                                </tr>
                                                <tr>
                                                    <td>Agama</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="text" name="agama" class="form-control" >
                                                    </td>
                                                    <td>Status Kepegawaian</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="text" name="status_kepegawaian" class="form-control" >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td>:</td>
                                                    <td><input type="text" name="status" class="form-control"></td>
                                                    <td>NIY / NIGK</td>
                                                    <td>:</td>
                                                    <td><input type="text" name="niy_nigk" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td>Kewarganegaraan</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="text" name="kewarganegaraan" class="form-control" ></td>
                                                        <td>NUPTK</td>
                                                        <td>:</td>
                                                        <td><input type="text" name="nuptk" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Ibu</td>
                                                        <td>:</td>
                                                        <td>
                                                            <input type="text" name="nm_ibu" class="form-control" ></td>
                                                            <td>SK Pengangkatan</td>
                                                            <td>:</td>
                                                            <td><input type="text" name="sk_pengangkatan" class="form-control" >
                                                            </td>
                                                        </tr>
                                                        <tr>

                                                            <td colspan="6" align="right"><br><br>
                                                                <button class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        {{Form::close()}}
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
            @endsection
