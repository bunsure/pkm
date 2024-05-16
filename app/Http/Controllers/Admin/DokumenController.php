<?php
namespace App\Http\Controllers\Admin;

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


class DokumenController extends Controller
{
     function index(){
     	return view("backend.dokumen.index");
     }

     function get_record($id_dokumen){
        $record = DB::table('dokumen as a')->where('id_dokumen', $id_dokumen)->first();
        if($record){
            //$record->informasi = "Nama Menu: ".$record->nama_menu;
            return response()->json($record);
        }else{
            return -1;
        }
     }
     function dt_dokumen(){
        $query = DB::table('dokumen as a')
        ->select('a.id_dokumen as id_dokumen','a.nama as nama','a.created_at','tipe',
            'a.filename as filename');

        return Datatables::of($query)
        ->addColumn('action', function ($query) {

            $edit = ""; $delete = "";
            if($this->auu()){
                $edit = '<a href="#" class="act" data-toggle="modal" data-id="'.$query->id_dokumen.'" data-target="#modal-form-edit-dokumen" title="Edit"><i class="la la-edit"></i></a> ';
            }
            if($this->aud()){
                $delete = '<a href="#" data-target="#modal-form-hapus-dokumen" data-id="'.$query->id_dokumen.'"  title="Hapus" data-toggle="modal" class="act"><i class="la la-trash"></i></a> ';
            }
            $action =  $edit."".$delete;
            if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

            return $action;
        })
         ->addColumn('nama', function ($query) {
            $dokumen = "";
            $link = url($query->filename);
            if($query->tipe=='file'){
                $dokumen = '<a href="https://docs.google.com/viewer?url='.$link.'" target="_top">'.$query->nama.'</a>';
            }else{
                $dokumen = '<a href="'.$link.'" target="_top">'.$query->nama.'</a>';
            }
            return $dokumen;
        })
        ->addIndexColumn()
         ->rawColumns(['nama', 'action'])
        ->make(true);
     }

     function insert(Request $request){
        $validator = Validator::make($request->all(), [
          'dokumen' => 'required|mimes:jpeg,jpg,png,pdf,xls,xlsx,doc,docx|max:2048',
          'nama' => 'required',
        ]);

        if ($validator->passes()) {
            $nama_dokumen = trim(strtolower($request->nama));
            $nama_dokumen = str_replace(" ", "-", $nama_dokumen);
            $randomID = $this->randomID();
            $randomFileID = $nama_dokumen."-".$randomID;
            $file = $request->file('dokumen');
            $extension = strtolower($request->dokumen->getClientOriginalExtension());
            $fileupload = $randomFileID.'.'.$extension;
            $request->dokumen->move(public_path('upload/dokumen'), $fileupload);
            $tipe_file = ['pdf','xls','xlsx','doc','docx'];
            $tipe_gambar= ['jpeg','jpg','png'];

            if(in_array($extension, $tipe_file)){
                $tipe = "file";
            }
            if(in_array($extension, $tipe_gambar)){
                $tipe = "gambar";
            }
            $record = array("id_dokumen"=>$randomID, 
                "nama"=>$request->nama, 
                "tipe"=>$tipe, 
                "filename"=> 'upload/dokumen/'.$fileupload,
                'created_at'=>date("Y-m-d H:i:s"), 
                'created_by'=>Auth::user()->username);
            DB::table('dokumen')->insert($record);

            $respon = array('status'=>true,'message'=>"Dokumen Berhasil Diupload!");
            return response()->json($respon);

        }else{
            $respon = array('status'=>false,'message'=>'File Gagal Diupload <br> Jenis dan Ukuran File Tidak Valid!');
            return response()->json($respon);
        }
     }

     function update(Request $request){
        $validator = Validator::make($request->all(), [
         // 'dokumen' => 'required|mimes:jpeg,jpg,png,pdf,xls,xlsx,doc,docx|max:2048',
          'nama' => 'required',
        ]);

        if ($validator->passes()) {
            
            $record = array( 
                "nama"=>$request->nama);
            DB::table('dokumen')->where('id_dokumen',$request->id_dokumen)->update($record);

            $respon = array('status'=>true,'message'=>"Nama Dokumen Berhasil Disimpan!");
            return response()->json($respon);

        }else{
            $respon = array('status'=>false,'message'=>'Gagal Ubah Nama Dokumen');
            return response()->json($respon);
        }
     }

     function delete(Request $request){
        $validator = Validator::make($request->all(), [
         // 'dokumen' => 'required|mimes:jpeg,jpg,png,pdf,xls,xlsx,doc,docx|max:2048',
          'nama' => 'required',
        ]);

        if ($validator->passes()) {
            
            $dokumen = DB::table('dokumen')->where('id_dokumen', $request->id_dokumen)->first();
            DB::table('dokumen')->where('id_dokumen',$request->id_dokumen)->delete();
            File::delete($dokumen->filename);
            $respon = array('status'=>true,'message'=>"Dokumen Berhasil Dihapus!");
            return response()->json($respon);

        }else{
            $respon = array('status'=>false,'message'=>'Gagal Hapus Dokumen');
            return response()->json($respon);
        }
     }
}