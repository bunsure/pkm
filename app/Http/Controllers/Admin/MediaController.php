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


class MediaController extends Controller
{
     function index(){
     	return view("backend.media.index");
     }

     function list_media(Request $r){
        $media = DB::table('media')->orderBy('id_media','desc')->paginate(12);
        return view('backend.media.list',array("media"=>$media));
     }

     function get_record($id){
        $record = DB::table('media as a')->where('id_media', $id)->first();
        if($record){
            $record->thumbs_url = url($record->thumbs);
            $record->filename_url = url($record->filename);
            return response()->json($record);
        }else{
            return -1;
        }
     }

     function insert(Request $request){
        
        $validator = Validator::make($request->all(), ['gambar'=>'required']);
        
        if(!$validator->fails()){
            if($request->hasFile('gambar')){
                    $id_media= $this->randomID();
                    $file = $request->file('gambar');
                    $extension = $file->getClientOriginalExtension();
                    $filetime = date("Ymdhis");
                    $random = $this->randomID();
                    $fileupload = strtolower($random.".".$extension);
                    $fileupload_thumbs = "thumb-".$fileupload;
                    $filename = "upload/media/".$fileupload;
                    $thumbs = "upload/media/". $fileupload_thumbs;

                    Image::make($file)->save($filename);
                    Image::make($file)->resize(400,null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($thumbs);

                    $img = Image::make($thumbs);
                    $img->crop(400, 300);
                    $img->save();
                
                    Storage::disk('public')->delete("upload/media/".$fileupload);
                    Storage::disk('public')->delete("upload/media/thumb-".$fileupload_thumbs);
                    
                    $record = array(
                        //"caption"=>$request->caption, 
                        "id_media"=>$id_media,
                        "filename"=>$filename,
                        "thumbs"=>$thumbs
                    );

                    DB::table('media')->insert($record);
                    return  response()->json(['status' => true,'message'=>"Media Berhasil Diupload!"]);
            }
        }        
        
        return  response()->json(['status' => false,'message'=>"Terjadi Kesalahan, Gagal Upload Media!"]);
     }


     function delete(Request $r){
        $id_media = $r->id_media;
        $gambar = DB::table('media')->where('id_media', $id_media)->first();
        $respon = array('status'=>true,'message'=>'Data Photo Berhasil Dihapus!');
        DB::table('media')->where('id_media',$r->id_media)->delete();   

        File::delete($gambar->filename);
        File::delete($gambar->thumbs);   
        return response()->json($respon); 
     }

}