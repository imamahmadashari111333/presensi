<?php
Route::group( ['middleware' => 'guest'] , function() {
	Route::get('/', 'IndexController@index');
	Route::get('/log-in', function () {
		return view('auth.login'); });
	Route::get('/presensi-berangkat', 'IndexController@presensiberangkat');
	Route::get('/presensi-pulang', 'IndexController@presensipulang');
	Route::get('/cekdata', 'IndexController@cekdata');
	Route::get('/kehadiran-hari-ini', 'IndexController@kehadiran');
	Route::post('/simpan-presensi-berangkat', 'IndexController@simpanpresensiberangkat');
	Route::post('/simpan-presensi-pulang/{id}', 'IndexController@simpanpresensipulang');
	Route::get('/panduan', 'IndexController@panduan');
	Route::get('/jenis-cuti', 'IndexController@jeniscuti');
	Route::get('/data-pegawai', 'IndexController@datapegawai');
	Route::post('/simpan-data-pegawai', 'IndexController@simpandatapegawai');
	Route::post('/simpan-register', 'IndexController@simpanregister');
	Route::get('/input-ijin', 'IndexController@ijincuti');
	Route::post('/simpan-ijin-pegawai', 'IndexController@simpanijin');
});

Auth::routes();
Route::group( ['middleware' => 'admin'] , function() {
	Route::get('/dashboard', 'AdminController@dashboard');
	Route::get('/cetak-laporan', 'AdminController@cetaklaporan');

	Route::get('/jumlah-kehadiran', 'AdminController@jumlahkehadiran');
	Route::get('/detail-presensi', 'AdminController@detailpresensi');

	//Data Guru
	Route::get('/data-guru-tk25', 'AdminController@dataguru25');
	Route::get('/data-guru-tk50', 'AdminController@dataguru50');
	Route::get('/data-guru-sdqu', 'AdminController@datagurusdqu');
	//Jam masuk
	Route::get('/jam-masuk', 'AdminController@jammasuk');
	Route::post('/simpan-jam', 'AdminController@simpanjam');
	Route::post('update-jam/{id}', 'AdminController@updatejam');
	Route::get('/{id}/edit-jam', 'AdminController@editjam');
	Route::post('/hapus-jam/{id}', 'AdminController@hapusjam');

	//Ijin cuti masuk
	Route::get('/ijin-cuti', 'AdminController@ijincuti');
	Route::post('update-ijin/{id}', 'AdminController@updateijin');
	Route::get('/{id}/edit-ijin', 'AdminController@editijin');
	Route::post('/hapus-ijin/{id}', 'AdminController@hapusijin');

	//User
	Route::get('/tambah-user', 'AdminController@tambahuser');
	Route::post('/simpan-user', 'AdminController@simpanuser');
	Route::get('/admin', 'AdminController@admin');
	Route::get('/kepala-unit', 'AdminController@kepalaunit');
	Route::get('/pegawai', 'AdminController@pegawai');
	Route::get('/arsip-pegawai', 'AdminController@arsippegawai');

	//Data presensi
	Route::get('/data-presensi', 'AdminController@datapresensi');
	Route::get('/presensi', 'AdminController@presensi');
	Route::get('/laporan', 'AdminController@laporan');
	Route::get('/rekap-laporan', 'AdminController@rekaplaporan');
	Route::post('update-presensi/{id}', 'AdminController@updatepresensi');

	//Biodata
	Route::get('/biodata', 'AdminController@account');
	Route::get('/{id}/edit-biodata', 'AdminController@editbiodata');
	Route::post('/update-biodata/{id}', 'AdminController@updatebiodata');
	Route::get('/cek-presensi', 'AdminController@cekpresensi');
	Route::get('/biodata', 'AdminController@biodata');
	Route::get('/{id}/detail-biodata', 'AdminController@detailbiodata');
	Route::get('/{id}/edit-data', 'AdminController@editdata');
	Route::post('/update-data/{id}', 'AdminController@updatedata');
	Route::post('/hapus-data/{id}', 'AdminController@hapusdata');
	
});
