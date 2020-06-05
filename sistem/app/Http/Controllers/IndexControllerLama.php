<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Detailuser;
use App\Alamat;
use App\Kontak;
use App\Kepegawaian;
use App\Presensi;
use DB;
use Session;
use Redirect;
use Image;
use Input;
use Larinfo;


class IndexController extends Controller
{
    public function index()
    {
        $nama = DB::select('select * from users');
        return view('home.index', compact('nama'));
    }

    public function presensiberangkat()
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $nig = $_GET['nig'];
        $data = DB::select('select * from users where password_presensi = "'.$nig.'"');
        return view('home.presensi-berangkat', compact('data'));
    }

    public function presensipulang()
    {
        date_default_timezone_set('Asia/Jakarta');
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $id = User::find($id);
        $nig = $_GET['nig'];
        $data = DB::select('select * from users where password_presensi = "'.$nig.'"');
        $cekwf = DB::select('select keterangan from tb_jammasuk');
        foreach ($cekwf as $key => $value) {
            $keterangan_kerja = $value->keterangan; 
        }
        return view('home.presensi-pulang', compact('data','keterangan_kerja'));
    }

    public function simpanpresensiberangkat(Request $request)
    {
        $id_user = $_POST['id_user'];
        // $berangkat  = date("h:i:s || d-m-Y");
        date_default_timezone_set('Asia/Jakarta');
        $berangkat  = date("H:i:s");
        $tanggal  = date("d-m-Y");

        $agent = new \Jenssegers\Agent\Agent;
        if ($result = $agent->isDesktop()) {
            $hardware = "Laptop";
        }  elseif ($result = $agent->isMobile()) {
            $hardware = "Handphone";
        }  elseif ($result = $agent->isTablet()) {
            $hardware = "Tablet";
        } 
        
        //cek wfh dan wfo
        $cekwf = DB::select('select keterangan from tb_jammasuk');
        foreach ($cekwf as $key => $value) {
            $keterangan_kerja = $value->keterangan; 
        }

        if ($keterangan_kerja == 'WFO') {
            if ('-7.421369, 109.270660' <= $request->lokasi >= '-7.421473, 109.272314') {
                $presensi = new Presensi();
                $presensi->id_user = $id_user;
                $presensi->berangkat = $berangkat;
                $presensi->lokasi_berangkat = $request->lokasi;
                $presensi->tanggal = $tanggal;
                $presensi->hardware = $hardware;
                $tumbukan = 
                DB::select('select id_user from tb_presensi where id_user = "'.$id_user.'" and  tanggal="'.date('d-m-Y').'"');
                if ($tumbukan) {
                    Session::flash('gagal', 'Anda sudah melakukan presensi berangkat');
                }else{
                    $presensi->save();
                    Session::flash('sukses', 'Anda berhasil melakukan presensi berangkat');
                    return Redirect::to('/');
                }
                return back();
            } else {
                Session::flash('gagal', 'Anda di luar jangkauan');
            }
            
        } elseif ($keterangan_kerja == 'WFH') {
            if ('-7.421369, 109.270660' >= $request->lokasi <= '-7.421473, 109.272314') {
                $presensi = new Presensi();
                $presensi->id_user = $id_user;
                $presensi->berangkat = $berangkat;
                $presensi->lokasi_berangkat = $request->lokasi;
                $presensi->tanggal = $tanggal;
                $presensi->hardware = $hardware;
                $tumbukan = 
                DB::select('select id_user from tb_presensi where id_user = "'.$id_user.'" and  tanggal="'.date('d-m-Y').'"');
                if ($tumbukan) {
                    Session::flash('gagal', 'Anda sudah melakukan presensi berangkat');
                }else{
                    $presensi->save();
                    Session::flash('sukses', 'Anda berhasil melakukan presensi berangkat');
                    return Redirect::to('/');
                }
                return back();
            } else {
                Session::flash('gagal', 'Anda di luar jangkauan');
            }
        }
        
    }

    public function simpanpresensipulang(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $pulang  = date("H:i:s");

        $cek = 
        DB::select('select * from tb_presensi where id_user = "'.$id.'" and  tanggal="'.date('d-m-Y').'"');

        if (empty($cek)) {
            Session::flash('gagal', 'Anda belum melakukan presensi berangkat');
        }else{
            $ubah = DB::update("Update tb_presensi SET pulang = '".$pulang."', lokasi_pulang = '".$request->lokasi."' where id_user = '".$id."' order by id DESC limit 1");
            Session::flash('sukses', 'Anda berhasil melakukan presensi pulang');
        }

        
        return Redirect::to('/');
    }

    public function ijincuti()
    {
        date_default_timezone_set('Asia/Jakarta');
        $jam  = date("H:i:s");
        $nama = DB::select('select * from users');
        $tanggal  = date("d-m-Y");
        $data = DB::select('Select users.name, tb_jammasuk.jammasuk, tb_jammasuk.sabtu, tb_jammasuk.minggu, tb_presensi.berangkat, tb_presensi.keterangan, tb_presensi.keterangan_rinci, tb_presensi.pulang, tb_presensi.tanggal, DATE_FORMAT(tb_presensi.created_at, "%Y/%m/%d") as created_at 
            from users
            left join tb_presensi ON users.id = tb_presensi.id_user 
            left join tb_jammasuk ON users.id = tb_jammasuk.id_user
            where tb_presensi.tanggal = "'.$tanggal.'" and NOT tb_presensi.keterangan = "" group by users.id
            order by tb_presensi.created_at ASC');
        return view('home.ijin-cuti', compact('data','nama','tanggal','jam'));
    }

    public function simpanijin(Request $request)
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        date_default_timezone_set('Asia/Jakarta');
        $nig = $request->nig;
        $data = DB::Select('select id from users WHERE password_presensi = "'.$nig.'"');
        foreach ($data as $key => $value) {
            $id_user = $value->id;
        }

        
        $presensi = new Presensi();
        $presensi->id_user = $id_user;
        $presensi->cuti = 1;
        $presensi->keterangan = $_POST['keterangan'];
        $presensi->keterangan_rinci = $_POST['keterangan_rinci'];
        $presensi->tanggal = $request->tanggal;

        if ($request->tanggal) {
                $tgl=$request->tanggal;
                $xp=explode("-",$tgl);
                $rr=array($xp[2],$xp[1],$xp[0]);
                $tanggal=implode("-",$rr);
                $presensi->created_at = $tanggal;
            }

        $tumbukan = 
        DB::select('select id_user from tb_presensi where id_user = "'.$id_user.'" and  tanggal="'.date('d-m-Y').'"');
        if ($tumbukan) {
            Session::flash('gagal', 'Sudah mengisi ijin hari ini');
        }else{
            $presensi->save();
            Session::flash('sukses', 'Data berhasil disimpan');
            return back();
        }
        return back();
    }

    public function kehadiran()
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        date_default_timezone_set('Asia/Jakarta');
        $tanggal  = date("d-m-Y");
        $data = DB::select('Select users.name, tb_jammasuk.jammasuk, tb_jammasuk.sabtu, tb_jammasuk.minggu, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.tanggal, DATE_FORMAT(tb_presensi.created_at, "%Y/%m/%d") as created_at 
            from users
            left join tb_presensi ON users.id = tb_presensi.id_user 
            left join tb_jammasuk ON users.id = tb_jammasuk.id_user
            where tb_presensi.tanggal = "'.$tanggal.'" group by users.id
            order by tb_presensi.created_at ASC');
        foreach ($data as $key => $value) {
            $gettanggal = $value->created_at;
        }

       //  $daftar_hari = array(
       //     'Sunday' => 'Minggu',
       //     'Monday' => 'Senin',
       //     'Tuesday' => 'Selasa',
       //     'Wednesday' => 'Rabu',
       //     'Thursday' => 'Kamis',
       //     'Friday' => 'Jumat',
       //     'Saturday' => 'Sabtu'
       // );

        $namahari = date('l', strtotime($gettanggal));
        return view('home.kehadiran', compact('data','tanggal','namahari'));
    }

    public function simpanregister(Request $request)
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $acak=rand(11111,99999);
        $id_t = str_shuffle($acak);

        if (Input::hasFile('foto'))
        {
            $file = array('foto' => Input::file('foto'));
            if (Input::file('foto')->isValid()) 
            {
                $destinationPath = 'images/presensi';
                $extension = Input::file('foto')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111,99999).'.'.$extension; // renaming image
                $green = Input::file('foto');
                $img = Image::make($green)->resize('211','255')->save('images/presensi/'.$fileName);
                $input['foto'] =$destinationPath. '/'.$fileName;  

                $pegawai = new Detailuser();
                $pegawai->id_user = $id_t;
                $pegawai->nm_lengkap = $_POST['nm_lengkap'];
                $pegawai->jk = $_POST['jk'];
                $pegawai->nik = $_POST['nik'];
                $pegawai->tempat = $_POST['tempat'];
                $pegawai->tgl_lahir = $_POST['tgl_lahir'];
                $pegawai->agama = $_POST['agama'];
                $pegawai->status = $_POST['status'];
                $pegawai->kewarganegaraan = $_POST['kewarganegaraan'];
                $pegawai->nm_ibu = $_POST['nm_ibu'];
                Session::flash('sukses', 'Data berhasil ditambahkan');
                $pegawai->save();

                $nig = $_POST['nig'];

                $user = new User();
                $user->id = $id_t;
                $user->foto = $input['foto'];
                $user->name = $_POST['nm_lengkap'];
                $user->email= $_POST['email'];
                $user->username = $_POST['username'];
                $user->password = bcrypt($_POST['password']);
                $user->level = $_POST['level'];
                $user->status = 'Aktif';
                $user->unit = $_POST['unit'];
                $user->password_presensi = $_POST['nig'];
                Session::flash('sukses', 'Data berhasil ditambahkan');
                $user->save();

                $alamat = new Alamat();
                $alamat->id_user = $id_t;
                $alamat->jl = $_POST['jl'];
                $alamat->rt = $_POST['rt'];
                $alamat->rw = $_POST['rw'];
                $alamat->dusun = $_POST['dusun'];
                $alamat->desa = $_POST['desa'];
                $alamat->kecamatan = $_POST['kecamatan'];
                $alamat->kode_pos = $_POST['kode_pos'];
                Session::flash('sukses', 'Data berhasil ditambahkan');
                $alamat->save();

                $kontak = new Kontak();
                $kontak->id_user = $id_t;
                $kontak->no_telp = $_POST['no_telp'];
                $kontak->no_hp = $_POST['no_hp'];
                $kontak->email = $_POST['email'];
                Session::flash('sukses', 'Data berhasil ditambahkan');
                $kontak->save();

                $kepegawaian = new Kepegawaian();
                $kepegawaian->id_user = $id_t;
                $kepegawaian->status_kepegawaian = $_POST['status_kepegawaian'];
                $kepegawaian->nig = $_POST['nig'];
                $kepegawaian->niy_nigk = $_POST['niy_nigk'];
                $kepegawaian->nuptk = $_POST['nuptk'];
                $kepegawaian->sk_pengangkatan = $_POST['sk_pengangkatan'];
                Session::flash('sukses', 'Data berhasil ditambahkan');
                $kepegawaian->save();   

                Session::flash('sukses', 'Data berhasil disimpan');
                return back();
            }
        } else {
            $pegawai = new Detailuser();
            $pegawai->id_user = $id_t;
            $pegawai->nm_lengkap = $_POST['nm_lengkap'];
            $pegawai->jk = $_POST['jk'];
            $pegawai->nik = $_POST['nik'];
            $pegawai->tempat = $_POST['tempat'];
            $pegawai->tgl_lahir = $_POST['tgl_lahir'];
            $pegawai->agama = $_POST['agama'];
            $pegawai->status = $_POST['status'];
            $pegawai->kewarganegaraan = $_POST['kewarganegaraan'];
            $pegawai->nm_ibu = $_POST['nm_ibu'];
            Session::flash('sukses', 'Data berhasil ditambahkan');
            $pegawai->save();

            $user = new User();
            $user->id = $id_t;
            $user->foto = $input['foto'];
            $user->name = $_POST['nm_lengkap'];
            $user->email= $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($_POST['password']);
            $user->level = $request->level;
            $user->unit = $request->unit;
            $user->status = 'Aktif';
            $user->password_presensi = $_POST['password_presensi'];
            Session::flash('sukses', 'Data berhasil ditambahkan');
            $user->save();

            $alamat = new Alamat();
            $alamat->id_user = $id_t;
            $alamat->jl = $_POST['jl'];
            $alamat->rt = $_POST['rt'];
            $alamat->rw = $_POST['rw'];
            $alamat->dusun = $_POST['dusun'];
            $alamat->desa = $_POST['desa'];
            $alamat->kecamatan = $_POST['kecamatan'];
            $alamat->kode_pos = $_POST['kode_pos'];
            Session::flash('sukses', 'Data berhasil ditambahkan');
            $alamat->save();

            $kontak = new Kontak();
            $kontak->id_user = $id_t;
            $kontak->no_telp = $_POST['no_telp'];
            $kontak->no_hp = $_POST['no_hp'];
            $kontak->email = $_POST['email'];
            Session::flash('sukses', 'Data berhasil ditambahkan');
            $kontak->save();

            $kepegawaian = new Kepegawaian();
            $kepegawaian->id_user = $id_t;
            $kepegawaian->status_kepegawaian = $_POST['status_kepegawaian'];
            $kepegawaian->nig = $_POST['nig'];
            $kepegawaian->niy_nigk = $_POST['niy_nigk'];
            $kepegawaian->nuptk = $_POST['nuptk'];
            $kepegawaian->sk_pengangkatan = $_POST['sk_pengangkatan'];
            Session::flash('sukses', 'Data berhasil ditambahkan');
            $kepegawaian->save();   

            Session::flash('sukses', 'Data berhasil disimpan');
            return back();
        }   
    }

















    public function simpangambar()
    {
        $name = date('YmdHis');
        $acak=rand(111111111,999999999);
        $idt = str_shuffle($acak);
        $newname="webcam/images/".$name.".jpg";
        $file = file_put_contents( $newname, file_get_contents('php://input') );
        if (!$file) {
            print "ERROR: Failed to write data to $filename, check permissions\n";
            exit();
        }
        else
        {
            $data = new Gambar;
            $data->id = $idt;
            $data->name = $_POST['name'];
            $data->images = $newname;
            $data->save();
        }

        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $newname;
        print "$url\n";

    }

    public function panduan()
    {
        return view('home.panduan');
    }

    public function jeniscuti()
    {
        $data = DB::select('select * from tb_jeniscuti');
        return view('home.jenis-cuti', compact('data'));
    }

    public function datapegawai()
    {
        $data = DB::select('select * from users where users.level != "Admin" Order by users.password_presensi ASC');
        return view('home.data-pegawai', compact('data'));
    }

    public function simpandatapegawai(Request $request)
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

        $acak=rand(11111,99999);
        $id_t = str_shuffle($acak);

        $pegawai = new Pegawai();
        $pegawai->id = $id_t;
        $pegawai->nm_lengkap = $_POST['nm_lengkap'];
        $pegawai->jk = $_POST['jk'];
        $pegawai->nik = $_POST['nik'];
        $pegawai->tempat = $_POST['tempat'];
        $pegawai->tgl_lahir = $_POST['tgl_lahir'];
        $pegawai->agama = $_POST['agama'];
        $pegawai->status = $_POST['status'];
        $pegawai->kewarganegaraan = $_POST['kewarganegaraan'];
        $pegawai->nm_ibu = $_POST['nm_ibu'];
        Session::flash('sukses', 'Data berhasil ditambahkan');
        $pegawai->save();

        $nig = $_POST['nig'];

        $user = new User();
        $user->id = $id_t;
        $user->name = $_POST['nm_lengkap'];
        $user->username = $_POST['username'];
        $user->password = bcrypt($_POST['password']);
        $user->level = $_POST['level'];
        $user->password_presensi = $nig;
        Session::flash('sukses', 'Data berhasil ditambahkan');
        $user->save();

        $alamat = new Alamat();
        $alamat->id_pegawai = $id_t;
        $alamat->jl = $_POST['jl'];
        $alamat->rt = $_POST['rt'];
        $alamat->rw = $_POST['rw'];
        $alamat->dusun = $_POST['dusun'];
        $alamat->desa = $_POST['desa'];
        $alamat->kecamatan = $_POST['kecamatan'];
        $alamat->kode_pos = $_POST['kode_pos'];
        Session::flash('sukses', 'Data berhasil ditambahkan');
        $alamat->save();

        $kontak = new Kontak();
        $kontak->id_pegawai = $id_t;
        $kontak->no_telp = $_POST['no_telp'];
        $kontak->no_hp = $_POST['no_hp'];
        $kontak->email = $_POST['email'];
        Session::flash('sukses', 'Data berhasil ditambahkan');
        $kontak->save();

        $kepegawaian = new Kepegawaian();
        $kepegawaian->id_pegawai = $id_t;
        $kepegawaian->status_kepegawaian = $_POST['status_kepegawaian'];
        $kepegawaian->nig = $_POST['nig'];
        $kepegawaian->niy_nigk = $_POST['niy_nigk'];
        $kepegawaian->nuptk = $_POST['nuptk'];
        $kepegawaian->sk_pengangkatan = $_POST['sk_pengangkatan'];
        Session::flash('sukses', 'Data berhasil ditambahkan');
        $kepegawaian->save();   

        return back();
        Session::flash('sukses', 'Data berhasil ditambahkan');
    }
}
