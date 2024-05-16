<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/gen-uuid', function () {
    list($usec, $sec) = explode(" ", microtime());
	$time = ((float)$usec + (float)$sec);
	$time = str_replace(".", "-", $time);
	$panjang = strlen($time);
	$sisa = substr($time, -1*($panjang-5));
	return Uuid::generate(3,rand(10,99).rand(0,9).substr($time, 0,5).'-'.rand(0,9).rand(0,9)."-".$sisa,Uuid::NS_DNS);
});

Route::get('/','PageController@home');

Route::get('/getcaptcha', 'KontakController@get_capctha');
Route::get('/kontak-kami', 'KontakController@index_kontak_kami');
Route::post('/kirim-pesan', 'KontakController@kirim_pesan');
Route::get('/kotak-pengaduan', 'KontakController@index_kotak_pengaduan');
Route::get('/kotak-pengaduan/submit/{id}', 'KontakController@pengaduan_dokumen_submit');
Route::get('/kotak-pengaduan/info-pengaduan/{id}', 'KontakController@info_pengaduan');
Route::post('/kirim-pengaduan', 'KontakController@kirim_pengaduan');
Route::post('/upload-dokumen-pengaduan', 'KontakController@upload_dokumen');
Route::post('/kirim-pengaduan-akhir', 'KontakController@kirim_pengaduan_akhir');

//berita
Route::get('/baca-berita/{uuid}', 'PageController@baca_berita');
Route::get('/list-berita', 'PageController@list_berita');
//halaman
Route::get('/baca-halaman/{uuid}', 'PageController@baca_halaman');
//gallery
Route::get('/gallery', 'PageController@gallery');
//download
Route::get('/download', 'PageController@download');
//lowongan kerja
Route::get('/baca-loker/{uuid}', 'PageController@baca_loker');
Route::get('/list-loker', 'PageController@list_loker');

//Visi dan Misi
Route::get('/visi','PageController@visi');

//Tata Nilai
Route::get('/tata-nilai','PageController@tata');

//Hak dan Kewajiban
Route::get('/hak-kewajiban','PageController@hak'); 

Route::get('/login', function () {
    return view('backend.login');
});
Route::get('/logout','Admin\LoginController@logout');

Route::post('/submit-login','Admin\LoginController@submit_login');

Route::group(['prefix'=>'backend'], function(){

	
	Route::get('/ganti-password', 'Admin\LoginController@ganti_password');
	Route::post('/ganti-password/submit', 'Admin\LoginController@submit_password');

	Route::middleware(['auth.login','auth.menu'])->group(function(){
		Route::get('/','Admin\HomeController@index');
		//SETING MENU
		Route::group(['prefix'=>'setting-menu'], function(){
			Route::get('/','Admin\SettingController@indexMenu');
			Route::get('/dt','Admin\SettingController@data_menu');
			Route::get('/get/{uuid}','Admin\SettingController@get_data_menu');
			Route::post('/insert','Admin\SettingController@insert_menu');
			Route::post('/update','Admin\SettingController@update_menu');
			Route::post('/delete','Admin\SettingController@delete_menu');
		});

		//SETING ROLE
		Route::group(['prefix'=>'setting-role'], function(){
			Route::get('/','Admin\SettingController@indexRole');
			Route::get('/dt','Admin\SettingController@data_role');
			Route::get('/get/{uuid}','Admin\SettingController@get_data_role');
			Route::post('/insert','Admin\SettingController@insert_role');
			Route::post('/update','Admin\SettingController@update_role');
			Route::post('/delete','Admin\SettingController@delete_role');

			Route::get('/menu/{uuid_role}', 'Admin\SettingController@index_role_menu');
			Route::get('/menu/{uuid_role}/dt', 'Admin\SettingController@data_role_menu');
			Route::get('/menu/{uuid_role}/get/{uuid}', 'Admin\SettingController@getRecordRoleMenu');
			Route::post('/menu/{uuid_role}/insert', 'Admin\SettingController@insert_role_menu');
			Route::post('/menu/{uuid_role}/update', 'Admin\SettingController@update_role_menu');
			Route::post('/menu/{uuid_role}/delete', 'Admin\SettingController@delete_role_menu');
		});

		//setting-user
		Route::group(['prefix'=>'setting-user'], function(){
			Route::get('/','Admin\SettingController@indexUser');
			Route::get('/dt','Admin\SettingController@data_user');
			Route::get('/get/{uuid}','Admin\SettingController@getRecordUser');
			Route::post('/insert','Admin\SettingController@insert_user');
			Route::post('/update','Admin\SettingController@update_user');
			Route::post('/delete','Admin\SettingController@delete_user');
			Route::post('/password','Admin\SettingController@update_password');

			//USER > ROLE
			Route::get('/role/uuid/{uuid}', 'Admin\SettingController@index_user_role');
			Route::get('/role/data/{uuid}', 'Admin\SettingController@data_user_role');
			Route::get('/role/get/{uuid}', 'Admin\SettingController@getRecordUserRole');
			Route::post('/role/insert', 'Admin\SettingController@insert_user_role');
			Route::post('/role/update', 'Admin\SettingController@update_user_role');
			Route::post('/role/delete', 'Admin\SettingController@delete_user_role');
		});

		//halaman berita halaman-berita

		Route::group(['prefix'=>'halaman-berita'], function(){
			Route::get('/','Admin\PageController@indexBerita');
			Route::get('/new','Admin\PageController@new_berita');
			Route::get('/edit/{uuid}','Admin\PageController@edit_berita');
			Route::get('/view/{uuid}','Admin\PageController@view_berita');
			Route::get('/dt','Admin\PageController@dt_berita');
			Route::get('/get/{uuid}','Admin\PageController@get_data_berita');
			Route::post('/insert','Admin\PageController@insert_berita');
			Route::post('/update','Admin\PageController@update_berita');
			Route::post('/delete','Admin\PageController@delete_berita');
			Route::post('/upload-gambar','Admin\PageController@upload_gambar_berita');
		});

		//halaman loker
		Route::group(['prefix'=>'loker'],function(){
			Route::get('/','Admin\PageController@indexLoker');
			Route::get('/new','Admin\PageController@new_loker');
			Route::get('/edit/{uuid}','Admin\PageController@edit_loker');
			Route::get('/view/{uuid}','Admin\PageController@view_loker');
			Route::get('/dt','Admin\PageController@dt_loker');
			Route::get('/get/{uuid}','Admin\PageController@get_data_loker');
			Route::post('/insert','Admin\PageController@insert_loker');
			Route::post('/update','Admin\PageController@update_loker');
			Route::post('/delete','Admin\PageController@delete_loker');
			Route::post('/upload-gambar','Admin\PageController@upload_gambar_loker');
		});

		//Halaman Pembelajaran halaman-pembelajaran

		Route::group(['prefix'=>'halaman-pembelajaran'], function(){
			Route::get('/','Admin\PageController@indexPembelajaran');
			Route::get('/new','Admin\PageController@new_pembelajaran');
			Route::get('/edit/{uuid}','Admin\PageController@edit_pembelajaran');
			Route::get('/view/{uuid}','Admin\PageController@view_pembelajaran');
			Route::get('/dt','Admin\PageController@dt_pembelajaran');
			Route::get('/get/{uuid}','Admin\PageController@get_data_pembelajaran');
			Route::post('/insert','Admin\PageController@insert_pembelajaran');
			Route::post('/update','Admin\PageController@update_pembelajaran');
			Route::post('/delete','Admin\PageController@delete_pembelajaran');
			Route::post('/upload-gambar','Admin\PageController@upload_gambar_pembelajaran');
		});

		//Halaman Budaya Baca halaman-budayabaca

		Route::group(['prefix'=>'halaman-budayabaca'], function(){
			Route::get('/','Admin\PageController@indexBudayabaca');
			Route::get('/new','Admin\PageController@new_budayabaca');
			Route::get('/edit/{uuid}','Admin\PageController@edit_budayabaca');
			Route::get('/view/{uuid}','Admin\PageController@view_budayabaca');
			Route::get('/dt','Admin\PageController@dt_budayabaca');
			Route::get('/get/{uuid}','Admin\PageController@get_data_budayabaca');
			Route::post('/insert','Admin\PageController@insert_budayabaca');
			Route::post('/update','Admin\PageController@update_budayabaca');
			Route::post('/delete','Admin\PageController@delete_budayabaca');
			Route::post('/upload-gambar','Admin\PageController@upload_gambar_budayabaca');
		});

		//Halaman Manajemen Sekolah halaman-manajemen
		Route::group(['prefix'=>'halaman-manajemen'], function(){
			Route::get('/','Admin\PageController@indexManajemen');
			Route::get('/new','Admin\PageController@new_manajemen');
			Route::get('/edit/{uuid}','Admin\PageController@edit_manajemen');
			Route::get('/view/{uuid}','Admin\PageController@view_manajemen');
			Route::get('/dt','Admin\PageController@dt_manajemen');
			Route::get('/get/{uuid}','Admin\PageController@get_data_manajemen');
			Route::post('/insert','Admin\PageController@insert_manajemen');
			Route::post('/update','Admin\PageController@update_manajemen');
			Route::post('/delete','Admin\PageController@delete_manajemen');
			Route::post('/upload-gambar','Admin\PageController@upload_gambar_manajemen');
		});



		//Halaman parenting halaman-parenting
		Route::group(['prefix'=>'halaman-parenting'], function(){
			Route::get('/','Admin\PageController@indexParenting');
			Route::get('/new','Admin\PageController@new_parenting');
			Route::get('/edit/{uuid}','Admin\PageController@edit_parenting');
			Route::get('/view/{uuid}','Admin\PageController@view_parenting');
			Route::get('/dt','Admin\PageController@dt_parenting');
			Route::get('/get/{uuid}','Admin\PageController@get_data_parenting');
			Route::post('/insert','Admin\PageController@insert_parenting');
			Route::post('/update','Admin\PageController@update_parenting');
			Route::post('/delete','Admin\PageController@delete_parenting');
			Route::post('/upload-gambar','Admin\PageController@upload_gambar_parenting');
		});

		//Halaman Literasi halaman-literasi
		Route::group(['prefix'=>'halaman-literasi'], function(){
			Route::get('/','Admin\PageController@indexLiterasi');
			Route::get('/new','Admin\PageController@new_literasi');
			Route::get('/edit/{uuid}','Admin\PageController@edit_literasi');
			Route::get('/view/{uuid}','Admin\PageController@view_literasi');
			Route::get('/dt','Admin\PageController@dt_literasi');
			Route::get('/get/{uuid}','Admin\PageController@get_data_literasi');
			Route::post('/insert','Admin\PageController@insert_literasi');
			Route::post('/update','Admin\PageController@update_literasi');
			Route::post('/delete','Admin\PageController@delete_literasi');
			Route::post('/upload-gambar','Admin\PageController@upload_gambar_literasi');
		});

		//Halaman Sosok Inspiratif halaman-inspiratif
		Route::group(['prefix'=>'halaman-inspiratif'], function(){
			Route::get('/','Admin\PageController@indexInspiratif');
			Route::get('/new','Admin\PageController@new_inspiratif');
			Route::get('/edit/{uuid}','Admin\PageController@edit_inspiratif');
			Route::get('/view/{uuid}','Admin\PageController@view_inspiratif');
			Route::get('/dt','Admin\PageController@dt_inspiratif');
			Route::get('/get/{uuid}','Admin\PageController@get_data_inspiratif');
			Route::post('/insert','Admin\PageController@insert_inspiratif');
			Route::post('/update','Admin\PageController@update_inspiratif');
			Route::post('/delete','Admin\PageController@delete_inspiratif');
			Route::post('/upload-gambar','Admin\PageController@upload_gambar_inspiratif');
		});

		Route::group(['prefix'=>'dokumen'], function(){
			Route::get('/','Admin\DokumenController@index');
			Route::get('/get/{id}','Admin\DokumenController@get_record');
			Route::get('/dt','Admin\DokumenController@dt_dokumen');
			Route::post('/insert','Admin\DokumenController@insert');
			Route::post('/update','Admin\DokumenController@update');
			Route::post('/delete','Admin\DokumenController@delete');
		});

		Route::group(['prefix'=>'halaman-statis'], function(){
			Route::get('/','Admin\PageController@indexHalaman');
			Route::get('/new','Admin\PageController@new_halaman');
			Route::get('/edit/{uuid}','Admin\PageController@edit_halaman');
			Route::get('/view/{uuid}','Admin\PageController@view_halaman');
			Route::get('/dt','Admin\PageController@dt_halaman');
			Route::get('/get/{uuid}','Admin\PageController@get_data_halaman');
			Route::post('/insert','Admin\PageController@insert_halaman');
			Route::post('/update','Admin\PageController@update_halaman');
			Route::post('/delete','Admin\PageController@delete_halaman');
			Route::post('/upload-gambar','Admin\PageController@upload_gambar_halaman');
		});

		Route::group(['prefix'=>'list-gambar'], function(){
			Route::get('/session/{session}','Admin\PageController@list_gambar_session');
			Route::get('/berita/{id_berita}','Admin\PageController@list_gambar_berita');
			Route::get('/get/{id_gambar}','Admin\PageController@get_detail_gambar');
			Route::post('/update-caption','Admin\PageController@update_caption_gambar');
			Route::post('/delete','Admin\PageController@delete_gambar');
		});

		Route::group(['prefix'=>'halaman-menu'], function(){
			Route::get('/','Admin\HalamanMenuController@index');
			Route::get('/get/{id}','Admin\HalamanMenuController@get_data_node');
			Route::get('/form-edit/{id}','Admin\HalamanMenuController@form_edit_node');
			Route::get('/get-node','Admin\HalamanMenuController@get_node');
			Route::post('/insert','Admin\HalamanMenuController@insert_node');
			Route::post('/update','Admin\HalamanMenuController@update_node');
			Route::post('/delete','Admin\HalamanMenuController@delete_node');
		});

		Route::group(['prefix'=>'gallery-photo'], function(){
			Route::get('/','Admin\GalleryController@index');
			Route::get('/get/{id}','Admin\GalleryController@get_record');
			Route::get('/list','Admin\GalleryController@list_gallery');
			Route::post('/insert','Admin\GalleryController@insert');
			Route::post('/update','Admin\GalleryController@update');
			Route::post('/delete','Admin\GalleryController@delete');
		});

		Route::group(['prefix'=>'widget'], function(){
			Route::get('/','Admin\WidgetController@index');
			Route::get('/edit/{id}','Admin\WidgetController@edit_widget');
			Route::post('/update','Admin\WidgetController@update');
		});

		Route::group(['prefix'=>'media'], function(){
			Route::get('/','Admin\MediaController@index');
			Route::get('/get/{id}','Admin\MediaController@get_record');
			Route::get('/list','Admin\MediaController@list_media');
			Route::post('/insert','Admin\MediaController@insert');
			Route::post('/delete','Admin\MediaController@delete');
		});

		Route::group(['prefix'=>'download'], function(){
			Route::get('/','Admin\DownloadController@index');
			Route::get('/get/{id}','Admin\DownloadController@get_record');
			Route::get('/dt','Admin\DownloadController@dt_download');
			Route::post('/insert','Admin\DownloadController@insert');
			Route::post('/update','Admin\DownloadController@update');
			Route::post('/delete','Admin\DownloadController@delete');
		});


		Route::group(['prefix'=>'kotak-pesan'], function(){
			Route::get('/','Admin\KotakController@index_pesan');
			Route::get('/detail/{id}','Admin\KotakController@detail_pesan');
			Route::get('/dt','Admin\KotakController@dt_pesan');
			Route::get('/view/{id}','Admin\KotakController@view_pesan');
		});
		

		Route::group(['prefix'=>'kotak-pengaduan'], function(){
			Route::get('/','Admin\KotakController@index_pengaduan');
			Route::get('/dt','Admin\KotakController@dt_pengaduan');
			Route::get('/view/{id}','Admin\KotakController@view_pengaduan');
		});


	});	
});

Route::get('passwd',function(){
		return Hash::make('masukjang');
});

Route::get('passwd2',function(){
		return Hash::make('batanghari');
});

