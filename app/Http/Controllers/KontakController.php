<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Session;
use Auth;
use Hash;
use Datatables;


use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;


class KontakController extends Controller
{
     function index_kontak_kami(){
        $titlepage ="Kontak Kami";
        return view('kontak.pesan',compact('titlepage'));
     }

     function get_capctha(){
        $arr = array("A","1","B","2","C","3","D","4","5","E","G","6","H","7","8","K","9","L","P","0","T","2","S","U","4");
        $capctha = "";
        for ($i=0;$i<5;$i++){
            $capctha .= $arr[array_rand($arr)];
        }
        Session::put('capctha', $capctha);
        return view('kontak.captcha');
     }

     function kirim_pesan(Request $r){
        $validator = Validator::make($r->all(), [
          'nama_lengkap' => 'required',
          'pesan' => 'required',
          'subjek' => 'required',
          'email' => 'required',
          'phone' => 'required',
          'captcha' => 'required',
        ]);

        if ($validator->passes()) {
            $captcha = $r->captcha;
            if($captcha!=Session::get('capctha')){
                $respon = array('status'=>false,'message'=>'Kode Capctha Tidak Sesuai!');
                return response()->json($respon);
            }
            $record = array(
                "id_pesan"=>$this->randomID(),
                "pesan"=>trim($r->pesan),
                "email"=>trim($r->email),
                "subjek"=>trim($r->subjek),
                "phone"=>trim($r->phone),
                "nama_lengkap"=>trim($r->nama_lengkap),
                "created_at"=>date('Y-m-d H:i:s'),
                "dibaca"=>0
                );
            DB::table('pesan')->insert($record);
            $respon = array('status'=>true,'message'=>"Terima Kasih, Pesan Anda Berhasil Dikirim!");
            return response()->json($respon);

        }else{
            $respon = array('status'=>false,'message'=>'Gagal Kirim Pesan, Mohon Ulangi Lagi!');
            return response()->json($respon);
        }
     }

     function index_kotak_pengaduan(){
        $titlepage ="Kotak Pengaduan";
        return view('kontak.pengaduan',compact('titlepage'));
     }

     function kirim_pengaduan(Request $r){
        $validator = Validator::make($r->all(), [
          'nama_lengkap' => 'required',
          'nomor_id' => 'required',
          'organisasi' => 'required',
          'subjek' => 'required',
          'email' => 'required',
          'phone' => 'required',
          'isi_pengaduan' => 'required',
          'captcha' => 'required',
        ]);

        if ($validator->passes()) {
            $captcha = $r->captcha;
            if($captcha!=Session::get('capctha')){
                $respon = array('status'=>false,'message'=>'Kode Capctha Tidak Sesuai!');
                return response()->json($respon);
            }
            $id_pengaduan = $this->randomID();
            $record = array(
                "id_pengaduan"=>$id_pengaduan,
                "isi_pengaduan"=>trim($r->isi_pengaduan),
                "email"=>trim($r->email),
                "subjek"=>trim($r->subjek),
                "phone"=>trim($r->phone),
                "nomor_id"=>trim($r->nomor_id),
                "organisasi"=>trim($r->organisasi),
                "nama_lengkap"=>trim($r->nama_lengkap),
                "created_at"=>date('Y-m-d H:i:s'),
                "submit"=>0,
                "dibaca"=>0,
                );
            DB::table('pengaduan')->insert($record);
            $respon = array('status'=>true,'message'=>"", "id"=>$id_pengaduan);
            return response()->json($respon);

        }else{
            $respon = array('status'=>false,'message'=>'Gagal Kirim Pesan, Mohon Ulangi Lagi!');
            return response()->json($respon);
        }
     }

     function pengaduan_dokumen_submit($id_pengaduan){
        $pengaduan = DB::table('pengaduan')->where('id_pengaduan', $id_pengaduan)->first();
        if($pengaduan->submit==1){
            return redirect('info-pengaduan/'.$pengaduan->id_pengaduan);
        }
        $titlepage ="Kotak Pengaduan";
        return view('kontak.pengaduan-submit',compact('titlepage','pengaduan'));
     }

     //Pengaduan Terikirm, Selanjutnya Silahkan Lampirkan Dokumen Pendukung Untuk Melengkapi Pengaduan Anda

     function kirim_pengaduan_akhir(Request $request){
            $id_pengaduan = $request->id_pengaduan;
            $last_nomor = DB::table('pengaduan')->orderby('nomor_pengaduan','desc')->first();
            if($last_nomor){
                $nomor_pengaduan = ((int)$last_nomor->nomor_pengaduan + 1);
                $nomor_pengaduan =  str_pad($nomor_pengaduan,5,"0",STR_PAD_LEFT);
            }else{
                $nomor_pengaduan = "00001";
            }
            $pengaduan = DB::table('pengaduan')->where('id_pengaduan', $id_pengaduan)->first();
            if($pengaduan->submit==1){
                return false;
            }
            
            $allow_ext = ['pdf','xls','xlsx','doc','docx','jpeg','jpg','png'];
            //upload dokumen 1
            if($request->hasFile('dokumen1')){
                $filename = $request->dokumen1->getClientOriginalName();
                $extension = strtolower($request->dokumen1->getClientOriginalExtension());
                if(in_array($extension, $allow_ext)){
                    $randomID = $this->randomID();
                    $nama_dokumen = trim(strtolower($filename));
                    $filename =  $randomID."-".str_replace(" ", "-", $nama_dokumen);
                    $request->dokumen1->move(public_path('upload/pengaduan'), $filename);
                    DB::table('dokumen_pengaduan')->insert(array(
                        "id_pengaduan"=>$id_pengaduan,
                        "nama_dokumen"=>$nama_dokumen,
                        "id_dokumen"=>$randomID,
                        "filename"=> 'upload/pengaduan/'.$filename,
                    ));
                }
            }

            //upload dokumen 2
            if($request->hasFile('dokumen2')){
                $filename = $request->dokumen2->getClientOriginalName();
                $extension = strtolower($request->dokumen2->getClientOriginalExtension());
                
                if(in_array($extension, $allow_ext)){
                    $randomID = $this->randomID();
                    $nama_dokumen = trim(strtolower($filename));
                    $filename =  $randomID."-".str_replace(" ", "-", $nama_dokumen);
                    $request->dokumen2->move(public_path('upload/pengaduan'), $filename);
                    DB::table('dokumen_pengaduan')->insert(array(
                        "id_pengaduan"=>$id_pengaduan,
                        "nama_dokumen"=>$nama_dokumen,
                        "id_dokumen"=>$randomID,
                        "filename"=> 'upload/pengaduan/'.$filename,
                    ));
                }
            }

            //upload dokumen 3
            if($request->hasFile('dokumen3')){
                $filename = $request->dokumen3->getClientOriginalName();
                $extension = strtolower($request->dokumen3->getClientOriginalExtension());
                
                if(in_array($extension, $allow_ext)){
                    $randomID = $this->randomID();
                    $nama_dokumen = trim(strtolower($filename));
                    $filename =  $randomID."-".str_replace(" ", "-", $nama_dokumen);
                    $request->dokumen3->move(public_path('upload/pengaduan'), $filename);
                    DB::table('dokumen_pengaduan')->insert(array(
                        "id_pengaduan"=>$id_pengaduan,
                        "nama_dokumen"=>$nama_dokumen,
                        "id_dokumen"=>$randomID,
                        "filename"=> 'upload/pengaduan/'.$filename,
                    ));
                }
            }

            //upload dokumen 4
            if($request->hasFile('dokumen4')){
                $filename = $request->dokumen4->getClientOriginalName();
                $extension = strtolower($request->dokumen4->getClientOriginalExtension());
                
                if(in_array($extension, $allow_ext)){
                    $randomID = $this->randomID();
                    $nama_dokumen = trim(strtolower($filename));
                    $filename =  $randomID."-".str_replace(" ", "-", $nama_dokumen);
                    $request->dokumen4->move(public_path('upload/pengaduan'), $filename);
                    DB::table('dokumen_pengaduan')->insert(array(
                        "id_pengaduan"=>$id_pengaduan,
                        "nama_dokumen"=>$nama_dokumen,
                        "id_dokumen"=>$randomID,
                        "filename"=> 'upload/pengaduan/'.$filename,
                    ));
                }
            }


            //upload dokumen 5
            if($request->hasFile('dokumen5')){
                $filename = $request->dokumen5->getClientOriginalName();
                $extension = strtolower($request->dokumen5->getClientOriginalExtension());
                
                if(in_array($extension, $allow_ext)){
                    $randomID = $this->randomID();
                    $nama_dokumen = trim(strtolower($filename));
                    $filename =  $randomID."-".str_replace(" ", "-", $nama_dokumen);
                    $request->dokumen5->move(public_path('upload/pengaduan'), $filename);
                    DB::table('dokumen_pengaduan')->insert(array(
                        "id_pengaduan"=>$id_pengaduan,
                        "nama_dokumen"=>$nama_dokumen,
                        "id_dokumen"=>$randomID,
                        "filename"=> 'upload/pengaduan/'.$filename,
                    ));
                }
            }
            
            $r = $request;
            $record = array(
                "isi_pengaduan"=>trim($r->isi_pengaduan),
                "nomor_pengaduan"=>trim($nomor_pengaduan),
                "email"=>trim($r->email),
                "subjek"=>trim($r->subjek),
                "phone"=>trim($r->phone),
                "nomor_id"=>trim($r->nomor_id),
                "organisasi"=>trim($r->organisasi),
                "nama_lengkap"=>trim($r->nama_lengkap),
                "created_at"=>date('Y-m-d H:i:s'),
                "submit"=>1,
                );
            DB::table('pengaduan')->where('id_pengaduan',$id_pengaduan)->update($record);
            $respon = array('status'=>true,'message'=>"Dokumen Berhasil Diupload!", "id"=>$id_pengaduan);
            return response()->json($respon);
     }

     function info_pengaduan($id_pengaduan){
        $pengaduan = DB::table('pengaduan')->where('id_pengaduan', $id_pengaduan)->first();
        $dokumen = DB::table('dokumen_pengaduan')->where('id_pengaduan', $id_pengaduan)->get();
        $titlepage ="Kotak Pengaduan";
        return view('kontak.info-pengaduan',compact('titlepage','pengaduan','dokumen'));
     }
}