<?php

namespace App\Http\Controllers;

use App\User;
use App\Detailuser;
use App\Alamat;
use App\Kontak;
use App\Jam;
use App\Presensi;
use App\Kepegawaian;
use App\ArsipPegawai;
use DB;
use Auth;
use Session;
use Image;
use Input;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function dashboard()
    {
        $data = DB::select('select * from users');
        $pegawai = DB::select('select count(id) as pegawai from users where level = "Pegawai"');
        foreach ($pegawai as $key => $value) {
            $jml_pegawai = $value->pegawai;
        }
        $presensi = DB::select('select count(id_user) as presensi from tb_presensi where tanggal="'.date('d-m-Y').'"');
        foreach ($presensi as $key => $value) {
            $jml_masuk = $value->presensi;
        }
        $ijin = DB::select('select count(id_user) as presensi from tb_presensi where tanggal="'.date('d-m-Y').'" and keterangan = "2"');
        foreach ($ijin as $key => $value) {
            $jml_ijin = $value->presensi;
        }
        $alfa = DB::select('select count(id_user) as presensi from tb_presensi where tanggal="'.date('d-m-Y').'" and keterangan = "3"');
        foreach ($alfa as $key => $value) {
            $jml_alfa = $value->presensi;
        }

        $jml_tidak_berangkat = $jml_pegawai - $jml_masuk;
        return view('admin.dashboard', compact('data','jml_masuk','jml_ijin','jml_alfa','jml_tidak_berangkat'));
    }

    public function dataguru25()
    {
        $data = DB::select('select * from users 
            left join tb_detail_user ON users.id = tb_detail_user.id_user
            left join tb_kepegawaian ON users.id = tb_kepegawaian.id_user
            left join tb_alamat ON users.id = tb_alamat.id_user
            left join tb_kontak ON users.id = tb_kontak.id_user
            where users.unit = "KB TK KHALIFAH 25" order by users.password_presensi ASC, users.name ASC');

        return view('admin.guru.tk25', compact('data'));
    }

    public function dataguru50()
    {
        $data = DB::select('select * from users 
            left join tb_detail_user ON users.id = tb_detail_user.id_user
            left join tb_kepegawaian ON users.id = tb_kepegawaian.id_user
            left join tb_alamat ON users.id = tb_alamat.id_user
            left join tb_kontak ON users.id = tb_kontak.id_user
            where users.unit = "KB TK KHALIFAH 50" order by users.password_presensi ASC, users.name ASC');

        return view('admin.guru.tk50', compact('data'));
    }

    public function datagurusdqu()
    {
        $data = DB::select('select * from users 
            left join tb_detail_user ON users.id = tb_detail_user.id_user
            left join tb_kepegawaian ON users.id = tb_kepegawaian.id_user
            left join tb_alamat ON users.id = tb_alamat.id_user
            left join tb_kontak ON users.id = tb_kontak.id_user
            where users.unit = "SD QU HANIFAH" order by users.password_presensi ASC, users.name ASC');

        return view('admin.guru.sdqu', compact('data'));
    }


    public function biodata()
    {
        $id = Auth::user()->id;
        $data = DB::select('select * from users 
            left join tb_detail_user ON users.id = tb_detail_user.id_user
            left join tb_kepegawaian ON users.id = tb_kepegawaian.id_user
            left join tb_alamat ON users.id = tb_alamat.id_user
            left join tb_kontak ON users.id = tb_kontak.id_user
            where users.id ="'.$id.'"');
        return view('admin.biodata.index', compact('data'));
    }

    public function editbiodata($id)
    {
        $user = User::find($id);
        $data = DB::select('select * from users 
            left join tb_detail_user ON users.id = tb_detail_user.id_user
            left join tb_kepegawaian ON users.id = tb_kepegawaian.id_user
            left join tb_alamat ON users.id = tb_alamat.id_user
            left join tb_kontak ON users.id = tb_kontak.id_user
            where users.id ="'.$id.'"');
        return view('admin.biodata.edit', compact('biodata','data','user'));
    }

    public function tambahuser()
    {
        return view('admin.user.tambah');
    }

    public function simpanuser(Request $request)
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $acak=rand(11111,99999);
        $id_t = str_shuffle($acak);

            $user = new User();
            $user->id = $id_t;
            $user->name = $_POST['nm_lengkap'];
            $user->email= $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($_POST['password']);
            $user->password_view = $request->password;
            $user->password_presensi = $request->password_presensi;
            $user->level = $request->level;
            $user->status = 'Aktif';
            $user->password_presensi = $_POST['nig'];
            $user->save();

            Session::flash('sukses', 'Data berhasil disimpan');
            return back();

    }

    public function updatebiodata(Request $request, $id)
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
                
                $user = User::find($id);
                $user->foto = $input['foto'];
                $user->save();
                Session::flash('sukses', 'Data berhasil di edit');
            }
        } else {
            Session::flash('sukses', 'Data berhasil di edit');
        }

        $name = $request->name;
        $username = $request->username;
        $email = $request->email;

        $user = User::find($id);
            if ($request->password == '') {
                # code...
            } else {
                $user->password = bcrypt($_POST['password']);
            }
        $user->save();

        $password_presensi = $request->password_presensi;

        $b = $request->nm_lengkap;
        $c = $request->jk;
        $d = $_POST['nik'];
        $e = $_POST['tempat'];
        $f = $_POST['tgl_lahir'];
        $g = $_POST['agama'];
        $h = $_POST['status'];
        $i = $_POST['kewarganegaraan'];
        $j = $_POST['nm_ibu'];

        $k = $_POST['jl'];
        $l = $_POST['rt'];
        $m = $_POST['rw'];
        $n = $_POST['dusun'];
        $o = $_POST['desa'];
        $p = $_POST['kecamatan'];
        $q = $_POST['kode_pos'];

        $r = $_POST['status_kepegawaian'];
        $z = $_POST['nig'];
        $s = $_POST['niy_nigk'];
        $t = $_POST['nuptk'];
        $u = $_POST['sk_pengangkatan'];
        $rr = $_POST['masa_kontrak'];

        $v = $_POST['no_telp'];
        $w = $_POST['no_hp'];
        $x = $_POST['email'];

        $ubah = DB::update("UPDATE users, tb_detail_user, tb_alamat, tb_kepegawaian, tb_kontak
         SET  users.name = '$name',
         users.username = '$username',
         users.email = '$email',

         tb_detail_user.nm_lengkap = '$b',
         tb_detail_user.jk = '$c',
         tb_detail_user.nik = '$d',
         tb_detail_user.tempat = '$e',
         tb_detail_user.tgl_lahir = '$f',
         tb_detail_user.agama = '$g',
         tb_detail_user.status = '$h',
         tb_detail_user.kewarganegaraan = '$i',
         tb_detail_user.nm_ibu = '$j',

         tb_alamat.jl = '$k',
         tb_alamat.rt = '$l',
         tb_alamat.rw = '$m',
         tb_alamat.dusun = '$n',
         tb_alamat.desa = '$o',
         tb_alamat.kecamatan = '$p',
         tb_alamat.kode_pos = '$q',

         tb_kepegawaian.status_kepegawaian = '$r',
         tb_kepegawaian.nig = '$z',
         tb_kepegawaian.niy_nigk = '$s',
         tb_kepegawaian.nuptk = '$t',
         tb_kepegawaian.sk_pengangkatan = '$u',
         tb_kepegawaian.masa_kontrak = '$rr',

         tb_kontak.no_telp = '$v',
         tb_kontak.no_hp = '$w',
         tb_kontak.email = '$x',

         users.password_presensi = '$z'

         where users.id = tb_detail_user.id_user and users.id=tb_alamat.id_user and users.id = tb_kepegawaian.id_user and users.id = tb_kontak.id_user and users.id ='$id'");

        Session::flash('sukses', 'Data berhasil disimpan');
        return back();
    }

    public function pegawai()
    {
        $data = DB::select('select * from users
            where level = "Pegawai" order by users.name ASC');
        return view('admin.user.pegawai', compact('data'));
    }

    public function admin()
    {
        $data = DB::select('select * from users where users.level = "Admin"');
        return view('admin.user.admin', compact('data'));
    }

    public function jammasuk()
    {
        $nama = DB::select('SELECT * from users WHERE id NOT IN ( SELECT id_user FROM tb_jammasuk )');
        $data = DB::select('select users.name, users.password_presensi, tb_jammasuk.id, tb_jammasuk.jammasuk, tb_jammasuk.sabtu, tb_jammasuk.minggu, tb_jammasuk.keterangan from  tb_jammasuk
            left join users ON  tb_jammasuk.id_user = users.id');
        return view('admin.jam-masuk.index', compact('data','nama'));
    }

    public function simpanjam()
    {
        $simpan = new Jam();
        $simpan->id_user = $_POST['id_user'];
        $simpan->jammasuk = $_POST['jammasuk'];
        $simpan->sabtu = $_POST['sabtu'];
        $simpan->minggu = $_POST['minggu'];
        $simpan->keterangan = $_POST['keterangan'];
        $simpan->save();
        Session::flash('sukses', 'Data berhasil di simpan');
        return back();
    }

    public function ijincuti()
    {
        $tanggal  = date("d-m-Y");
        $nama = DB::select('select * from users');
        $data = DB::select('select users.name, users.password_presensi, tb_presensi.id, tb_presensi.keterangan, tb_presensi.keterangan_rinci, tb_presensi.tanggal, tb_presensi.cuti from  tb_presensi
            left join users ON  tb_presensi.id_user = users.id
            where users.level != "Admin" 
            and tb_presensi.berangkat = "00:00:00"');
        return view('admin.ijin-cuti.index', compact('data','nama','tanggal'));
    }

    public function simpanijin(Request $request)
    {
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $id_user = $_POST['id_user'];

        date_default_timezone_set('Asia/Jakarta');

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

    public function hapusijin()
    {
       if(isset($_POST['delete_submit'])){
        $idArr = $_POST['checked_id'];
        foreach($idArr as $id){
            DB::delete("DELETE from tb_presensi where tb_presensi.id=".$id);

        } 
        Session::flash('sukses', 'Data berhasil di hapus');
        return back();
    }
}

public function updateijin($id)
{
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    date_default_timezone_set('Asia/Jakarta');
    $keterangan  = $_POST['keterangan'];
    $keterangan_rinci  = $_POST['keterangan_rinci'];
    DB::update("Update tb_presensi SET keterangan = '".$keterangan."' where id = '".$id."' ");
    DB::update("Update tb_presensi SET keterangan_rinci = '".$keterangan_rinci."' where id = '".$id."' ");
    Session::flash('sukses', 'Data berhasil di update');
    return back();
}

public function kepalaunit()
{
    $data = DB::select('select * from users where users.level = "Kepala Unit"');
    return view('admin.user.kepala-unit', compact('data'));
}

public function detailbiodata($id)
{
    $user = User::find($id);
    $data = DB::select('select * from users where users.id ="'.$id.'"');
    return view('admin.user.detail-biodata', compact('biodata','data','user'));
}

public function editdata($id)
{
    $user = User::find($id);
    $data = DB::select('select * from users where users.id ="'.$id.'"');
    return view('admin.user.edit', compact('data','user'));
}

public function updatedata(Request $request, $id)
{

    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

        $ubah = DB::update("UPDATE users
         SET  users.name = '".$_POST['name']."',
         users.username = '".$_POST['username']."',
         users.email = '".$_POST['email']."',
         users.password_presensi = '".$_POST['password_presensi']."',
         users.password = '".bcrypt($_POST['password'])."'
         users.password_view = '".$_POST['password']."'
         where users.id ='$id'");

        Session::flash('sukses', 'Data berhasil disimpan');
        return back();
    }

    public function hapusdata()
    {
       if(isset($_POST['delete_submit'])){
        $idArr = $_POST['checked_id'];
        foreach($idArr as $id){
            $getdata = DB::select("select *
                from users
                where users.id = '$id'"); 

                if ($getdata) : 
                    foreach ($getdata as $row) : 
                        $data[$id][] = [ 
                            'id_user'           => $id,
                            'nama'              => $row->name,
                            'email'             => $row->email,
                            'level'             => $row->level
                        ];
                    endforeach;
                    ArsipPegawai::insert($data[$id]);
                endif;

            DB::delete('DELETE users
                FROM users
                WHERE users.id = "'.$id.'"');

        } 
        Session::flash('sukses', 'Data berhasil di arsipkan');
        return back();
    }
}

public function arsippegawai()
{
    $data = ArsipPegawai::all();
    return view('admin.user.arsip',compact('data'));
}

public function hapusjam(Request $request)
{
   if(isset($_POST['delete_submit'])){
    $idArr = $_POST['checked_id'];
    foreach($idArr as $id){
        DB::delete("DELETE from tb_jammasuk where tb_jammasuk.id=".$id);

    } 
    Session::flash('sukses', 'Data berhasil di hapus');
    return back();
    }
    // ------------------------------------------------------------
    elseif(isset($_POST['update_jammasuk'])){
    $idArr = $_POST['checked_id'];
    foreach($idArr as $id){
        if ($request->jammasuk == '00:00:00') {
            
        } else {
            DB::update("UPDATE tb_jammasuk SET jammasuk = '".$request->jammasuk."' where tb_jammasuk.id=".$id);
        }
        if ($request->sabtu == '00:00:00') {
            
        } else {
            DB::update("UPDATE tb_jammasuk SET sabtu = '".$request->sabtu."' where tb_jammasuk.id=".$id);
        }
        if ($request->minggu == '00:00:00') {
           
        } else {
             DB::update("UPDATE tb_jammasuk SET minggu = '".$request->minggu."' where tb_jammasuk.id=".$id);
        }
        
    } 
    Session::flash('sukses', 'Data jam masuk berhasil di update');
    return back();
    }
    // ------------------------------------------------------------
    elseif(isset($_POST['update_keterangan'])){
    $idArr = $_POST['checked_id'];
    foreach($idArr as $id){
            DB::update("UPDATE tb_jammasuk SET keterangan = '".$request->keterangan."' where tb_jammasuk.id=".$id);
    } 
    Session::flash('sukses', 'Data keterangan berhasil di update');
    return back();
    }
}

    // public function editjam($id)
    // {
    //     $nama = DB::select('select * from users');
    //     $data = DB::select('select users.name, tb_jammasuk.id, tb_detail_user.nik, tb_jammasuk.jammasuk from  tb_jammasuk
    //         left join users ON  tb_jammasuk.id_user = users.id
    //         left join tb_detail_user ON tb_jammasuk.id_user = tb_detail_user.id_user');
    //     $edit = Jam::find($id);
    //     return view('admin.jam-masuk.edit', compact('data','nama','edit'));
    // }

public function updatejam(Request $request, $id)
{
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    date_default_timezone_set('Asia/Jakarta');
    $jammasuk  = $_POST['jammasuk'];
    $sabtu = $_POST['sabtu'];
    $minggu = $_POST['minggu'];

    DB::update("Update tb_jammasuk SET jammasuk = '".$jammasuk."', sabtu = '".$sabtu."', minggu = '".$minggu."', keterangan = '".$request->keterangan."' where id = '".$id."' ");

    Session::flash('sukses', 'Data berhasil disimpan');
    return back();
}

public function updatepresensi(Request $request, $id)
{
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    date_default_timezone_set('Asia/Jakarta');
    $presensi = Presensi::find($id);
        $presensi->berangkat = $request->berangkat;
        $presensi->pulang = $request->pulang;
    $presensi->save();

    Session::flash('sukses', 'Data berhasil di edit');
    return back();
}

public function presensi()
{
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $tgl = DB::select('select tanggal from tb_presensi group by tanggal');
    date_default_timezone_set('Asia/Jakarta');
    $tanggal  = date('Y-m-d', strtotime('+1 day'));
    $tanggal2 = date('Y-m-d', strtotime('-2 month', strtotime($tanggal)));
    $data = DB::select('Select tb_presensi.id, users.name, tb_presensi.berangkat, tb_presensi.lokasi_berangkat, tb_presensi.hardware, tb_presensi.lokasi_pulang, tb_presensi.pulang, tb_presensi.tanggal, DAYNAME(tb_presensi.created_at) as hari, tb_jammasuk.jammasuk, tb_jammasuk.sabtu, tb_jammasuk.minggu
        from users
        JOIN tb_presensi ON users.id = tb_presensi.id_user
        JOIN tb_jammasuk ON users.id = tb_jammasuk.id_user
        Where tb_presensi.created_at between  "'.$tanggal2.'" and "'.$tanggal.'" 
        order by users.password_presensi ASC, users.name, tb_presensi.created_at ASC');
    return view('admin.laporan.index', compact('data','tanggal','tgl','data25','data50','datasdqu','datadaycare','datagraha','namahari'));
}

public function cetaklaporan()
{
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $tgl = DB::select('select tanggal from tb_presensi group by tanggal');
    date_default_timezone_set('Asia/Jakarta');
    $tanggal  = date("d-m-Y");
    $data = DB::select('Select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.tanggal from users, tb_presensi where users.id = tb_presensi.id_user and tb_presensi.tanggal = "'.$tanggal.'" ');
    $data25 = DB::select('Select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.tanggal from users, tb_presensi where users.id = tb_presensi.id_user and tb_presensi.tanggal = "'.$tanggal.'" and users.unit = "KB TK KHALIFAH 25"');
    $data50 = DB::select('Select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.tanggal from users, tb_presensi where users.id = tb_presensi.id_user and tb_presensi.tanggal = "'.$tanggal.'" and users.unit = "KB TK KHALIFAH 50"');
    $datasdqu = DB::select('Select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.tanggal from users, tb_presensi where users.id = tb_presensi.id_user and tb_presensi.tanggal = "'.$tanggal.'" and users.unit = "SD QU HANIFAH"');
    $datadaycare = DB::select('Select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.tanggal from users, tb_presensi where users.id = tb_presensi.id_user and tb_presensi.tanggal = "'.$tanggal.'" and users.unit = "Daycare"');
    $datagraha = DB::select('Select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.tanggal from users, tb_presensi where users.id = tb_presensi.id_user and tb_presensi.tanggal = "'.$tanggal.'" and users.unit = "Graha Sedekah"');
    return view('admin.laporan.cetak-laporan', compact('data','tanggal','tgl','data25','data50','datasdqu','datadaycare','datagraha'));
}

public function jumlahkehadiran()
{
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $tgl = DB::select('select tanggal from tb_presensi group by tanggal');
    date_default_timezone_set('Asia/Jakarta');
    $tanggal  = date("d-m-Y");
    $data = DB::select('Select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.tanggal from users, tb_presensi where users.id = tb_presensi.id_user and tb_presensi.tanggal = "'.$tanggal.'" ');
    return view('admin.laporan.jumlah-kehadiran', compact('data','tanggal','tgl'));
}

public function detailpresensi()
{
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $tgl = DB::select('select tanggal from tb_presensi group by tanggal');
    date_default_timezone_set('Asia/Jakarta');
    $tanggal  = date("d-m-Y");
    $data = DB::select('Select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.tanggal from users, tb_presensi where users.id = tb_presensi.id_user and tb_presensi.tanggal = "'.$tanggal.'" ');
    return view('admin.laporan.detail-presensi', compact('data','tanggal','tgl'));
}

public function laporan(Request $request)
{
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $dari1 = $request->dari;
    $sampai1 = $request->sampai;
    $dari  = date('Y-m-d', strtotime($request['dari']));
    // $sampai  = date('Y-m-d', strtotime($request['sampai']));
    $sampai  = date('Y-m-d', strtotime('1 DAY', strtotime($_GET['sampai'])));

    $tanggal1 = $request['dari'];

    $gettanggal = strtotime($sampai) -  strtotime($dari);

    $tanggal = DB::select('select date_format(created_at, "%d") as tanggal from tb_presensi where created_at between "'.$dari.'" and "'.$sampai.'" group by tanggal');

    // $dari1  = $request['dari'];
    // $sampai1  = $request['sampai'];
    // while (strtotime($dari1)<strtotime($sampai1)){
    // $dari1 = mktime(0,0,0,date('m',strtotime($dari1)),date('d',strtotime($dari1))+1,date('Y',strtotime($dari1)));
    // $dari1=date('Y-m-d', $dari1);
    // echo $dari1.'<br/>';
    // }

        // (CASE WHEN DAYNAME(b.created_at)="Sunday" THEN "Minggu"
        // WHEN DAYNAME(b.created_at)="Monday" THEN "Senin"
        // WHEN DAYNAME(b.created_at)="Tuesday" THEN "Selasa"
        // WHEN DAYNAME(b.created_at)="Wednesday" THEN "Rabu"
        // WHEN DAYNAME(b.created_at)="Thursday" THEN "Kamis"
        // WHEN DAYNAME(b.created_at)="Sunday" THEN "Jumat" ELSE "Sabtu" END ) as hari,

    $detail = DB::select('select s.id,  s.name, b.cuti, b.pulang, date_format(b.created_at, "%d") as tanggal,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "01" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "01" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "01" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "01" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "01" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "01" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h1,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "02" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "02" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "02" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "02" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "02" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "02" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h2,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "03" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "03" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "03" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "03" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "03" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "03" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h3,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "04" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "04" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "04" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "04" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "04" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "04" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h4,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "05" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "05" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "05" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "05" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "05" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "05" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h5,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "06" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "06" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "06" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "06" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "06" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "06" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h6,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "07" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "07" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "07" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "07" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "07" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "07" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h7,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "08" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "08" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "08" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "08" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "08" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "08" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h8,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "09" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "09" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "09" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "09" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "09" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "09" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h9,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "10" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "10" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "10" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "10" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "10" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "10" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h10,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "11" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "11" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "11" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "11" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "11" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "11" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h11,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "12" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "12" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "12" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "12" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "12" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "12" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h12,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "13" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "13" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "13" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "13" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "13" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "13" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h13,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "14" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "14" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "14" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "14" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "14" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "14" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h14,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "15" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "15" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "15" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "15" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "15" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "15" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h15,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "16" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "16" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "16" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "16" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "16" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "16" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h16,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "17" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "17" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "17" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "17" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "17" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "17" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h17,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "18" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "18" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "18" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "18" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "18" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "18" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h18,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "19" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "19" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "19" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "19" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "19" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "19" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h19,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "20" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "20" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "20" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "20" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "20" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "20" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h20,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "21" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "21" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "21" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "21" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "21" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "21" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h21,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "22" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "22" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "22" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "22" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "22" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "22" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h22,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "23" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "23" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "23" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "23" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "23" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "23" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h23,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "24" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "24" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "24" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "24" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "24" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "24" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h24,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "25" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "25" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "25" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "25" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "25" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "25" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h25,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "26" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "26" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "26" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "26" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "26" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "26" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h26,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "27" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "27" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "27" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "27" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "27" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "27" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h27,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "28" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "28" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "28" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "28" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "28" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "28" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h28,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "29" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "29" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "29" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "29" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "29" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "29" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h29,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "30" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "30" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "30" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "30" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "30" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "30" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h30,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "31" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "31" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "31" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "31" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "31" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "31" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h31,
    CASE when b.berangkat >  j.jammasuk THEN count(b.berangkat) - 1  else count(b.berangkat) + 1 END
     as YESSSSS,

       count(b.berangkat) - SUM(b.cuti) as berangkat,
       b.berangkat as jamberangkat, j.jammasuk as jammasuk
       from users s
       join tb_presensi b on s.id = b.id_user
       join tb_jammasuk j on s.id = j.id_user
       where b.created_at between "'.$dari.'" and "'.$sampai.'" 
       group by s.id, b.id_user
       order by s.password_presensi ASC');

$detailsdqu = DB::select('select  s.name, b.cuti, b.pulang,
    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "01" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "01" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "01" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "01" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "01" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "01" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h1,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "02" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "02" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "02" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "02" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "02" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "02" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h2,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "03" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "03" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "03" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "03" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "03" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "03" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h3,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "04" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "04" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "04" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "04" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "04" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "04" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h4,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "05" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "05" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "05" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "05" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "05" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "05" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h5,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "06" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "06" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "06" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "06" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "06" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "06" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h6,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "07" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "07" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "07" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "07" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "07" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "07" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h7,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "08" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "08" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "08" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "08" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "08" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "08" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h8,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "09" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "09" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "09" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "09" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "09" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "09" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h9,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "10" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "10" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "10" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "10" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "10" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "10" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h10,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "11" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "11" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "11" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "11" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "11" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "11" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h11,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "12" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "12" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "12" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "12" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "12" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "12" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h12,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "13" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "13" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "13" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "13" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "13" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "13" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h13,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "14" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "14" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "14" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "14" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "14" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "14" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h14,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "15" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "15" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "15" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "15" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "15" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "15" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h15,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "16" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "16" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "16" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "16" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "16" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "16" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h16,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "17" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "17" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "17" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "17" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "17" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "17" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h17,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "18" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "18" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "18" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "18" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "18" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "18" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h18,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "19" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "19" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "19" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "19" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "19" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "19" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h19,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "20" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "20" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "20" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "20" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "20" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "20" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h20,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "21" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "21" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "21" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "21" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "21" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "21" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h21,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "22" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "22" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "22" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "22" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "22" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "22" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h22,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "23" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "23" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "23" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "23" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "23" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "23" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h23,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "24" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "24" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "24" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "24" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "24" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "24" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h24,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "25" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "25" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "25" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "25" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "25" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "25" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h25,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "26" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "26" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "26" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "26" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "26" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "26" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h26,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "27" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "27" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "27" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "27" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "27" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "27" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h27,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "28" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "28" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "28" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "28" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "28" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "28" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h28,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "29" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "29" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "29" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "29" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "29" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "29" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h29,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "30" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "30" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "30" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "30" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "30" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "30" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h30,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "31" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "31" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "31" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "31" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "31" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "31" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h31,

   count(b.berangkat) - SUM(b.cuti) as berangkat
   from users s
   join tb_presensi b on s.id = b.id_user
   join tb_jammasuk j on s.id = j.id_user
   where s.unit = "SD QU HANIFAH" and b.created_at between "'.$dari.'" and "'.$sampai.'" 
   group by s.id, b.id_user
   order by s.password_presensi ASC');

$detailtk25 = DB::select('select  s.name,
    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "01" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "01" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "01" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "01" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "01" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "01" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h1,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "02" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "02" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "02" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "02" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "02" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "02" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h2,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "03" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "03" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "03" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "03" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "03" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "03" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h3,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "04" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "04" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "04" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "04" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "04" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "04" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h4,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "05" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "05" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "05" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "05" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "05" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "05" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h5,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "06" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "06" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "06" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "06" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "06" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "06" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h6,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "07" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "07" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "07" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "07" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "07" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "07" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h7,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "08" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "08" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "08" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "08" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "08" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "08" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h8,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "09" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "09" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "09" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "09" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "09" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "09" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h9,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "10" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "10" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "10" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "10" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "10" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "10" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h10,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "11" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "11" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "11" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "11" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "11" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "11" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h11,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "12" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "12" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "12" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "12" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "12" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "12" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h12,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "13" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "13" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "13" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "13" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "13" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "13" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h13,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "14" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "14" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "14" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "14" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "14" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "14" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h14,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "15" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "15" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "15" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "15" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "15" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "15" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h15,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "16" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "16" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "16" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "16" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "16" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "16" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h16,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "17" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "17" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "17" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "17" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "17" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "17" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h17,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "18" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "18" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "18" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "18" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "18" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "18" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h18,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "19" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "19" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "19" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "19" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "19" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "19" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h19,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "20" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "20" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "20" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "20" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "20" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "20" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h20,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "21" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "21" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "21" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "21" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "21" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "21" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h21,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "22" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "22" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "22" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "22" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "22" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "22" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h22,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "23" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "23" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "23" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "23" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "23" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "23" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h23,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "24" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "24" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "24" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "24" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "24" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "24" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h24,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "25" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "25" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "25" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "25" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "25" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "25" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h25,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "26" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "26" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "26" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "26" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "26" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "26" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h26,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "27" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "27" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "27" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "27" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "27" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "27" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h27,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "28" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "28" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "28" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "28" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "28" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "28" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h28,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "29" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "29" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "29" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "29" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "29" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "29" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h29,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "30" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "30" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "30" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "30" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "30" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "30" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h30,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "31" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "31" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "31" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "31" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "31" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "31" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h31,

   count(b.berangkat) - SUM(b.cuti) as berangkat
   from users s
   join tb_presensi b on s.id = b.id_user
   join tb_jammasuk j on s.id = j.id_user
   where s.unit = "KB TK KHALIFAH 25" and b.created_at between "'.$dari.'" and "'.$sampai.'" 
   group by s.id, b.id_user
   order by s.password_presensi ASC');

$detailtk50 = DB::select('select  s.name,
    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "01" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "01" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "01" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "01" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "01" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "01" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h1,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "02" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "02" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "02" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "02" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "02" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "02" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h2,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "03" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "03" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "03" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "03" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "03" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "03" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h3,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "04" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "04" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "04" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "04" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "04" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "04" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h4,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "05" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "05" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "05" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "05" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "05" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "05" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h5,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "06" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "06" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "06" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "06" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "06" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "06" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h6,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "07" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "07" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "07" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "07" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "07" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "07" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h7,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "08" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "08" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "08" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "08" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "08" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "08" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h8,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "09" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "09" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "09" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "09" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "09" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "09" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h9,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "10" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "10" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "10" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "10" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "10" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "10" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h10,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "11" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "11" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "11" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "11" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "11" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "11" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h11,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "12" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "12" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "12" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "12" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "12" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "12" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h12,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "13" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "13" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "13" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "13" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "13" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "13" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h13,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "14" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "14" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "14" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "14" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "14" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "14" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h14,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "15" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "15" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "15" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "15" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "15" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "15" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h15,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "16" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "16" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "16" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "16" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "16" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "16" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h16,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "17" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "17" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "17" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "17" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "17" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "17" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h17,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "18" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "18" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "18" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "18" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "18" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "18" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h18,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "19" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "19" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "19" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "19" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "19" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "19" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h19,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "20" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "20" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "20" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "20" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "20" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "20" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h20,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "21" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "21" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "21" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "21" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "21" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "21" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h21,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "22" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "22" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "22" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "22" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "22" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "22" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h22,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "23" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "23" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "23" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "23" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "23" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "23" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h23,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "24" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "24" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "24" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "24" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "24" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "24" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h24,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "25" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "25" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "25" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "25" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "25" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "25" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h25,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "26" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "26" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "26" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "26" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "26" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "26" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h26,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "27" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "27" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "27" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "27" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "27" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "27" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h27,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "28" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "28" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "28" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "28" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "28" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "28" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h28,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "29" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "29" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "29" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "29" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "29" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "29" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h29,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "30" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "30" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "30" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "30" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "30" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "30" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h30,

    SUM(CASE
    WHEN date_format(b.created_at, "%d") = "31" and b.keterangan = "1" THEN 1
    WHEN date_format(b.created_at, "%d") = "31" and b.keterangan = "2" THEN 2
    WHEN date_format(b.created_at, "%d") = "31" and b.keterangan = "3" THEN 3
    WHEN date_format(b.created_at, "%d") = "31" and NOT DAYNAME(b.created_at)="Saturday" and NOT DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.jammasuk
    WHEN date_format(b.created_at, "%d") = "31" and DAYNAME(b.created_at)="Saturday"  THEN b.berangkat - j.sabtu
    WHEN date_format(b.created_at, "%d") = "31" and DAYNAME(b.created_at)="Sunday" THEN b.berangkat - j.minggu
    ELSE 0
    END
    ) as h31,
    
   count(b.berangkat) - SUM(b.cuti) as berangkat
   from users s
   join tb_presensi b on s.id = b.id_user
   join tb_jammasuk j on s.id = j.id_user
   where s.unit = "KB TK KHALIFAH 50" and b.created_at between "'.$dari.'" and "'.$sampai.'" 
   group by s.id, b.id_user
   
   order by s.password_presensi ASC');



$data = DB::select('select users.name, count(tb_presensi.berangkat) as berangkat, tb_presensi.berangkat as jamberangkat, tb_jammasuk.jammasuk as jammasuk
    from users 
    left join tb_presensi ON users.id = tb_presensi.id_user 
    left join tb_jammasuk ON users.id = tb_jammasuk.id_user
    where tb_presensi.created_at between "'.$dari.'" and "'.$sampai.'" 
    group by users.id
    HAVING jamberangkat < jammasuk ');

$data25 = DB::select('select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.cuti, tb_presensi.tanggal , tb_jammasuk.jammasuk
    from users 
    left join tb_presensi ON users.id = tb_presensi.id_user 
    left join tb_jammasuk ON users.id = tb_jammasuk.id_user where tb_presensi.created_at between "'.$dari.'" and "'.$sampai.'" and users.unit = "KB TK KHALIFAH 25" order by users.name ASC, tb_presensi.created_at ASC');
$data50 = DB::select('select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.cuti, tb_presensi.tanggal , tb_jammasuk.jammasuk
    from users 
    left join tb_presensi ON users.id = tb_presensi.id_user 
    left join tb_jammasuk ON users.id = tb_jammasuk.id_user where tb_presensi.created_at between "'.$dari.'" and "'.$sampai.'" and users.unit = "KB TK KHALIFAH 50" order by users.name ASC, tb_presensi.created_at ASC');
$datasdqu = DB::select('select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.cuti, tb_presensi.tanggal , tb_jammasuk.jammasuk
    from users 
    left join tb_presensi ON users.id = tb_presensi.id_user 
    left join tb_jammasuk ON users.id = tb_jammasuk.id_user where tb_presensi.created_at between "'.$dari.'" and "'.$sampai.'" and users.unit = "SD QU HANIFAH" order by users.name ASC, tb_presensi.created_at ASC');
$datadaycare = DB::select('select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.cuti, tb_presensi.tanggal , tb_jammasuk.jammasuk
    from users 
    left join tb_presensi ON users.id = tb_presensi.id_user 
    left join tb_jammasuk ON users.id = tb_jammasuk.id_user where tb_presensi.created_at between "'.$dari.'" and "'.$sampai.'" and users.unit = "Daycare" order by users.name ASC, tb_presensi.created_at ASC');
$datagraha = DB::select('select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.cuti, tb_presensi.tanggal , tb_jammasuk.jammasuk
    from users 
    left join tb_presensi ON users.id = tb_presensi.id_user 
    left join tb_jammasuk ON users.id = tb_jammasuk.id_user where tb_presensi.created_at between "'.$dari.'" and "'.$sampai.'" and users.unit = "Graha Sedekah" order by users.name ASC, tb_presensi.created_at ASC');


return view('admin.laporan.lihat-laporan', compact('detail','dari','sampai','data','data25','data50','datasdqu','datadaycare','datagraha','datacoba','detailsdqu','detailtk25','detailtk50','tanggal','tanggal1','dari1','sampai1'));
}

public function rekaplaporan()
{
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];
    $sampai1  = date('Y-m-d', strtotime('1 DAY', strtotime($_GET['sampai'])));

    $data = DB::select('select users.name, COUNT(tb_presensi.berangkat) - COALESCE(SUM(tb_presensi.cuti),0) as jumlah, COALESCE(SUM(tb_presensi.cuti),0) as cuti, tb_presensi.keterangan from users 
        left join tb_presensi ON users.id = tb_presensi.id_user 
        where tb_presensi.created_at between "'.$dari.'" and "'.$sampai1.'" 
        group by users.name order by users.password_presensi ASC');

    $data25 = DB::select('select users.name, COUNT(tb_presensi.berangkat) - COALESCE(SUM(tb_presensi.cuti),0) as jumlah, COALESCE(SUM(tb_presensi.cuti),0) as cuti, tb_presensi.keterangan from users 
        left join tb_presensi ON users.id = tb_presensi.id_user 
        where tb_presensi.created_at between "'.$dari.'" and "'.$sampai1.'" and users.unit = "KB TK KHALIFAH 25"
        group by users.name order by users.password_presensi ASC');

    $data50 = DB::select('select users.name, COUNT(tb_presensi.berangkat) - COALESCE(SUM(tb_presensi.cuti),0) as jumlah, COALESCE(SUM(tb_presensi.cuti),0) as cuti, tb_presensi.keterangan from users 
        left join tb_presensi ON users.id = tb_presensi.id_user 
        where tb_presensi.created_at between "'.$dari.'" and "'.$sampai1.'" and users.unit = "KB TK KHALIFAH 50"
        group by users.name order by users.password_presensi ASC');

    $datasdqu = DB::select('select users.name, COUNT(tb_presensi.berangkat) - COALESCE(SUM(tb_presensi.cuti),0) as jumlah, COALESCE(SUM(tb_presensi.cuti),0) as cuti, tb_presensi.keterangan from users 
        left join tb_presensi ON users.id = tb_presensi.id_user 
        where tb_presensi.created_at between "'.$dari.'" and "'.$sampai1.'" and users.unit = "SD QU HANIFAH"
        group by users.name order by users.password_presensi ASC');

    $datadaycare = DB::select('select users.name, COUNT(tb_presensi.berangkat) - COALESCE(SUM(tb_presensi.cuti),0) as jumlah, COALESCE(SUM(tb_presensi.cuti),0) as cuti, tb_presensi.keterangan from users 
        left join tb_presensi ON users.id = tb_presensi.id_user 
        where tb_presensi.created_at between "'.$dari.'" and "'.$sampai1.'" and users.unit = "Daycare"
        group by users.name order by users.password_presensi ASC');

    $datagraha = DB::select('select users.name, COUNT(tb_presensi.berangkat) - COALESCE(SUM(tb_presensi.cuti),0) as jumlah, COALESCE(SUM(tb_presensi.cuti),0) as cuti, tb_presensi.keterangan from users 
        left join tb_presensi ON users.id = tb_presensi.id_user 
        where tb_presensi.created_at between "'.$dari.'" and "'.$sampai1.'" and users.unit = "Graha Sedekah"
        group by users.name order by users.password_presensi ASC');

    return view('admin.laporan.rekap-laporan', compact('dari','sampai','data','data25','data50','datasdqu','datadaycare','datagraha'));
}

public function cekpresensi()
{
    $id = Auth::user()->id;
    $data = DB::select('Select users.name, tb_presensi.berangkat, tb_presensi.pulang, tb_presensi.tanggal, DAYNAME(tb_presensi.created_at) as hari, tb_jammasuk.jammasuk, tb_jammasuk.sabtu, tb_jammasuk.minggu
        from users
        JOIN tb_presensi ON users.id = tb_presensi.id_user
        JOIN tb_jammasuk ON users.id = tb_jammasuk.id_user
        where users.id = "'.$id.'"
        order by tb_presensi.created_at DESC
        ');
    return view('admin.laporan.cek-presensi', compact('data'));
}

}
