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


class GalleryController extends Controller
{
     function index(){
     	return view("backend.gallery.index");
     }

     function list_gallery(Request $r){
        $photo = DB::table('gallery_photo')->orderBy('id_gallery','desc')->paginate(4);
        return view('backend.gallery.list-photo',array("photo"=>$photo));
     }

     function get_record($id){
        $record = DB::table('gallery_photo as a')->where('id_gallery', $id)->first();
        if($record){
            $record->thumbs_url = url($record->thumbs);
            $record->filename_url = url($record->filename);
            return response()->json($record);
        }else{
            return -1;
        }
     }

     function insert(Request $request){
        
        $validator = Validator::make($request->all(), ['caption' => 'required','gambar'=>'required']);
        
        if(!$validator->fails()){
            if($request->hasFile('gambar')){
                    $file = $request->file('gambar');
                    $extension = $file->getClientOriginalExtension();
                    $filetime = date("Ymdhis");
                    $random = $this->randomID();
                    $fileupload = strtolower($random.".".$extension);
                    $fileupload_thumbs = "thumb-".$fileupload;
                    $filename = "upload/gambar/".$fileupload;
                    $thumbs = "upload/gambar/". $fileupload_thumbs;

                    Image::make($file)->resize(1024,null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($filename);
                    Image::make($file)->resize(400,null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($thumbs);

                    $img = Image::make($thumbs);
                    $img->crop(300, 220);
                    $img->save();
                
                    Storage::disk('public')->delete("upload/gallery/".$fileupload);
                    Storage::disk('public')->delete("upload/gallery/thumb-".$fileupload_thumbs);
                    
                    $record = array(
                        "caption"=>$request->caption, 
                        "filename"=>$filename,
                        "thumbs"=>$thumbs
                    );

                    DB::table('gallery_photo')->insert($record);
                    return  response()->json(['status' => true,'message'=>"Photo Berhasil Diupload!"]);
            }
        }        
        
        return  response()->json(['status' => false,'message'=>"Terjadi Kesalahan, Gagal Upload Photo!"]);
     }

     function update(Request $r){
        $id_gallery = $r->id_gallery;
        $respon = array('status'=>true,'message'=>'Data Photo Berhasil Disimpan!');
        $record = array("caption"=>$r->caption);
        DB::table('gallery_photo')->where('id_gallery',$r->id_gallery)->update($record);      
        return response()->json($respon);
     }


     function delete(Request $r){
        $id_gallery = $r->id_gallery;
        $gambar = DB::table('gallery_photo')->where('id_gallery', $id_gallery)->first();
        $respon = array('status'=>true,'message'=>'Data Photo Berhasil Dihapus!');
        DB::table('gallery_photo')->where('id_gallery',$r->id_gallery)->delete();   

        File::delete($gambar->filename);
        File::delete($gambar->thumbs);   
        return response()->json($respon); 
     }

}