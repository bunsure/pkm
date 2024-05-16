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

class PageController extends Controller
{
     function indexBerita(){
     	return view("backend.berita.index");
     }

     function edit_berita($uuid){
        $berita = DB::table('berita')->where('uuid', $uuid)->first();
        if (!Session::has('session_upload_gambar_berita')){
            Session::put('session_upload_gambar_berita', $uuid);
        } 
        return view("backend.berita.edit", compact('berita'));
     }

     function view_berita($uuid){
        $berita = DB::table('berita')->where('uuid', $uuid)->first();
        $id_berita = $berita->id_berita;
        $gambar = DB::select("select a.* from gambar as a, gambar_berita as b where a.id_gambar = b.id_gambar and b.id_berita = $id_berita order by b.id_gambar_berita asc");
        return view("backend.berita.view", compact('berita','gambar'));
     }

     function dt_berita(){
        $query = DB::table('berita as a')
        ->select('a.id_berita as id_berita','a.judul as judul','a.uuid',
            'a.tgl_posting', 'a.create_by');

        return Datatables::of($query)
        ->editColumn('judul', function ($query) {

            return '<a href="'.url('backend/halaman-berita/view/'.$query->uuid).'" >'.$query->judul.'</a> ';
            //return $action;
        })
        ->addColumn('action', function ($query) {

            $edit = ""; $delete = "";
            if($this->auu()){
                $edit = '<a href="'.url('backend/halaman-berita/edit/'.$query->uuid).'" class="act" title="Edit"><i class="la la-edit"></i> Edit</a> ';
            }
            if($this->aud()){
                $delete = '<a href="#" data-uuid="'.$query->uuid.'" data-toggle="modal" data-target="#modal-form-hapus-berita" title="Hapus" class="act"><i class="la la-trash"></i> Hapus</a> ';
            }
            $action =  $edit."".$delete;
            if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

            return $action;
        })
        ->rawColumns(['judul', 'action'])
        ->addIndexColumn()
        ->make(true);
     }

     function get_data_berita($uuid){
        $record = DB::table('berita as a')->select('uuid','judul')->where('uuid', $uuid)->first();
        if($record){
            return response()->json($record);
        }else{
            return -1;
        }
     }

     function new_berita(){
        if (!Session::has('session_upload_gambar_berita')){
            Session::put('session_upload_gambar_berita', $this->GenUuid());
        }        
        return view("backend.berita.new");
     }

     function insert_berita(Request $r){
        $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
        if(!$validator->fails()){
            $tgl_posting= $r->tgl_posting;
            $isi = $r->isi;
            $judul = $r->judul;
            $uuid= $this->GenUuid();
            $record = array(
                "judul"=>$judul,
                "isi"=>$isi,
                "tgl_posting"=>$tgl_posting,
                "created_at"=>date("Y-m-d H:i:s"),
                "create_by"=>Auth::user()->username,
                "updated_at"=>date("Y-m-d H:i:s"),
                "update_by"=>Auth::user()->username,
                "uuid"=>$uuid
            );
            $r->session()->forget('session_upload_gambar_berita');
            DB::table('berita')->insert($record);
            $id_berita = DB::table('berita')->where('uuid', $uuid)->first()->id_berita;
            $id_gambar = $r->id_gambar;
            DB::table('gambar_berita')->where('id_berita', $id_berita)->delete();
            if (count($id_gambar)){
                foreach($id_gambar as $id){
                    $record = array("id_gambar"=>$id, 'id_berita'=>$id_berita);
                    DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                    DB::table('gambar_berita')->insert($record);
                }
            }
            return redirect('backend/halaman-berita')->with('success', 'Berita Berhasil Ditambahkan');
        }else{

        }
     }

     function update_berita(Request $r){
        $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
        if(!$validator->fails()){
            $tgl_posting= $r->tgl_posting;
            $isi = $r->isi;
            $judul = $r->judul;
            $uuid= $r->uuid;
            $record = array(
                "judul"=>$judul,
                "isi"=>$isi,
                "tgl_posting"=>$tgl_posting,
                "updated_at"=>date("Y-m-d H:i:s"),
                "update_by"=>Auth::user()->username,
            );
            $r->session()->forget('session_upload_gambar_berita');
            DB::table('berita')->where('uuid', $uuid)->update($record);
            $id_berita = DB::table('berita')->where('uuid', $uuid)->first()->id_berita;
            $id_gambar = $r->id_gambar;
            DB::table('gambar_berita')->where('id_berita', $id_berita)->delete();
            if (count($id_gambar)){
                foreach($id_gambar as $id){
                    $record = array("id_gambar"=>$id, 'id_berita'=>$id_berita);
                    DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                    DB::table('gambar_berita')->insert($record);
                }
            }
            return redirect('backend/halaman-berita')->with('success', 'Berita Berhasil Disimpan');
        }else{

        }
     }

     function delete_berita(Request $r){
        if(!$this->aud()){
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
            return response()->json($respon);
        }
        $respon = array('status'=>true,'message'=>'Berita Berhasil Dihapus!');
        DB::table('berita')->where('uuid',$r->uuid)->delete();          
        return response()->json($respon);
     }

     function upload_gambar_berita(Request $request){
        if (!Session::has('session_upload_gambar_berita')){
            $session = $this->GenUuid();
        }else{
            $session = Session::get('session_upload_gambar_berita');
        }        

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

                    Image::make($file)->resize(720,null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($filename);
                    Image::make($file)->resize(400,null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($thumbs);

                    $img = Image::make($thumbs);
                    $img->crop(400, 300);
                    $img->save();
                
                    Storage::disk('public')->delete("upload/gambar/".$fileupload);
                    Storage::disk('public')->delete("upload/gambar/thumb-".$fileupload_thumbs);
                    
                    $record = array(
                        "id_gambar"=>$random, 
                        "session"=>$session, 
                        "caption"=>$request->caption, 
                        "filename"=>$filename,
                        "thumbs"=>$thumbs,
                        "create_by"=>Auth::user()->username,
                        "created_at"=>date("Y-m-d H:i:s")
                    );

                    DB::table('gambar')->insert($record);
                    return  response()->json(['status' => true,'message'=>"Gambar Berhasil Diupload!"]);
            }
           
        }        
        
        return  response()->json(['status' => false,'message'=>"Terjadi Kesalahan, Gagal Upload Gambar!"]);
     }





     function indexPembelajaran(){
        return view("backend.pembelajaran.index");
    }

    function edit_pembelajaran($uuid){
       $pembelajaran = DB::table('pembelajaran')->where('uuid', $uuid)->first();
       if (!Session::has('session_upload_gambar_pembelajaran')){
           Session::put('session_upload_gambar_pembelajaran', $uuid);
       } 
       return view("backend.pembelajaran.edit", compact('pembelajaran'));
    }

    function view_pembelajaran($uuid){
       $pembelajaran = DB::table('pembelajaran')->where('uuid', $uuid)->first();
       $id_pembelajaran = $pembelajaran->id_pembelajaran;
       $gambar = DB::select("select a.* from gambar as a, gambar_pembelajaran as b where a.id_gambar = b.id_gambar and b.id_pembelajaran = $id_pembelajaran order by b.id_gambar_pembelajaran asc");
       return view("backend.pembelajaran.view", compact('pembelajaran','gambar'));
    }

    function dt_pembelajaran(){
       $query = DB::table('pembelajaran as a')
       ->select('a.id_pembelajaran as id_pembelajaran','a.judul as judul','a.uuid',
           'a.tgl_posting', 'a.create_by');

       return Datatables::of($query)
       ->editColumn('judul', function ($query) {

           return '<a href="'.url('backend/halaman-pembelajaran/view/'.$query->uuid).'" >'.$query->judul.'</a> ';
           //return $action;
       })
       ->addColumn('action', function ($query) {

           $edit = ""; $delete = "";
           if($this->auu()){
               $edit = '<a href="'.url('backend/halaman-pembelajaran/edit/'.$query->uuid).'" class="act" title="Edit"><i class="la la-edit"></i> Edit</a> ';
           }
           if($this->aud()){
               $delete = '<a href="#" data-uuid="'.$query->uuid.'" data-toggle="modal" data-target="#modal-form-hapus-pembelajaran" title="Hapus" class="act"><i class="la la-trash"></i> Hapus</a> ';
           }
           $action =  $edit."".$delete;
           if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

           return $action;
       })
       ->rawColumns(['judul', 'action'])
       ->addIndexColumn()
       ->make(true);
    }

    function get_data_pembelajaran($uuid){
       $record = DB::table('pembelajaran as a')->select('uuid','judul')->where('uuid', $uuid)->first();
       if($record){
           return response()->json($record);
       }else{
           return -1;
       }
    }

    function new_pembelajaran(){
       if (!Session::has('session_upload_gambar_pembelajaran')){
           Session::put('session_upload_gambar_pembelajaran', $this->GenUuid());
       }        
       return view("backend.pembelajaran.new");
    }

    function insert_pembelajaran(Request $r){
       $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
       if(!$validator->fails()){
           $tgl_posting= $r->tgl_posting;
           $isi = $r->isi;
           $judul = $r->judul;
           $uuid= $this->GenUuid();
           $record = array(
               "judul"=>$judul,
               "isi"=>$isi,
               "tgl_posting"=>$tgl_posting,
               "created_at"=>date("Y-m-d H:i:s"),
               "create_by"=>Auth::user()->username,
               "updated_at"=>date("Y-m-d H:i:s"),
               "update_by"=>Auth::user()->username,
               "uuid"=>$uuid
           );
           $r->session()->forget('session_upload_gambar_pembelajaran');
           DB::table('pembelajaran')->insert($record);
           $id_pembelajaran = DB::table('pembelajaran')->where('uuid', $uuid)->first()->id_pembelajaran;
           $id_gambar = $r->id_gambar;
           DB::table('gambar_pembelajaran')->where('id_pembelajaran', $id_pembelajaran)->delete();
           if (count($id_gambar)){
               foreach($id_gambar as $id){
                   $record = array("id_gambar"=>$id, 'id_pembelajaran'=>$id_pembelajaran);
                   DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                   DB::table('gambar_pembelajaran')->insert($record);
               }
           }
           return redirect('backend/halaman-pembelajaran')->with('success', 'Pembelajaran Berhasil Ditambahkan');
       }else{

       }
    }

    function update_pembelajaran(Request $r){
       $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
       if(!$validator->fails()){
           $tgl_posting= $r->tgl_posting;
           $isi = $r->isi;
           $judul = $r->judul;
           $uuid= $r->uuid;
           $record = array(
               "judul"=>$judul,
               "isi"=>$isi,
               "tgl_posting"=>$tgl_posting,
               "updated_at"=>date("Y-m-d H:i:s"),
               "update_by"=>Auth::user()->username,
           );
           $r->session()->forget('session_upload_gambar_pembelajaran');
           DB::table('pembelajaran')->where('uuid', $uuid)->update($record);
           $id_pembelajaran = DB::table('pembelajaran')->where('uuid', $uuid)->first()->id_pembelajaran;
           $id_gambar = $r->id_gambar;
           DB::table('gambar_pembelajaran')->where('id_pembelajaran', $id_pembelajaran)->delete();
           if (count($id_gambar)){
               foreach($id_gambar as $id){
                   $record = array("id_gambar"=>$id, 'id_pembelajaran'=>$id_pembelajaran);
                   DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                   DB::table('gambar_pembelajaran')->insert($record);
               }
           }
           return redirect('backend/halaman-pembelajaran')->with('success', 'Pembelajaran Berhasil Disimpan');
       }else{

       }
    }

    function delete_pembelajaran(Request $r){
       if(!$this->aud()){
           $respon = array('status'=>false,'message'=>'Akses Ditolak!');
           return response()->json($respon);
       }
       $respon = array('status'=>true,'message'=>'Pembelajaran Berhasil Dihapus!');
       DB::table('pembelajaran')->where('uuid',$r->uuid)->delete();          
       return response()->json($respon);
    }

    function upload_gambar_pembelajaran(Request $request){
       if (!Session::has('session_upload_gambar_pembelajaran')){
           $session = $this->GenUuid();
       }else{
           $session = Session::get('session_upload_gambar_pembelajaran');
       }        

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

                   Image::make($file)->resize(720,null, function ($constraint) {
                       $constraint->aspectRatio();
                   })->save($filename);
                   Image::make($file)->resize(400,null, function ($constraint) {
                       $constraint->aspectRatio();
                   })->save($thumbs);

                   $img = Image::make($thumbs);
                   $img->crop(400, 300);
                   $img->save();
               
                   Storage::disk('public')->delete("upload/gambar/".$fileupload);
                   Storage::disk('public')->delete("upload/gambar/thumb-".$fileupload_thumbs);
                   
                   $record = array(
                       "id_gambar"=>$random, 
                       "session"=>$session, 
                       "caption"=>$request->caption, 
                       "filename"=>$filename,
                       "thumbs"=>$thumbs,
                       "create_by"=>Auth::user()->username,
                       "created_at"=>date("Y-m-d H:i:s")
                   );

                   DB::table('gambar')->insert($record);
                   return  response()->json(['status' => true,'message'=>"Gambar Berhasil Diupload!"]);
           }
          
       }        
       
       return  response()->json(['status' => false,'message'=>"Terjadi Kesalahan, Gagal Upload Gambar!"]);
    }




    function indexBudayabaca(){
        return view("backend.budayabaca.index");
    }

    function edit_budayabaca($uuid){
       $budayabaca = DB::table('budayabaca')->where('uuid', $uuid)->first();
       if (!Session::has('session_upload_gambar_budayabaca')){
           Session::put('session_upload_gambar_budayabaca', $uuid);
       } 
       return view("backend.budayabaca.edit", compact('budayabaca'));
    }

    function view_budayabaca($uuid){
       $budayabaca = DB::table('budayabaca')->where('uuid', $uuid)->first();
       $id_budayabaca = $budayabaca->id_budayabaca;
       $gambar = DB::select("select a.* from gambar as a, gambar_budayabaca as b where a.id_gambar = b.id_gambar and b.id_budayabaca = $id_budayabaca order by b.id_gambar_budayabaca asc");
       return view("backend.budayabaca.view", compact('budayabaca','gambar'));
    }

    function dt_budayabaca(){
       $query = DB::table('budayabaca as a')
       ->select('a.id_budayabaca as id_budayabaca','a.judul as judul','a.uuid',
           'a.tgl_posting', 'a.create_by');

       return Datatables::of($query)
       ->editColumn('judul', function ($query) {

           return '<a href="'.url('backend/halaman-budayabaca/view/'.$query->uuid).'" >'.$query->judul.'</a> ';
           //return $action;
       })
       ->addColumn('action', function ($query) {

           $edit = ""; $delete = "";
           if($this->auu()){
               $edit = '<a href="'.url('backend/halaman-budayabaca/edit/'.$query->uuid).'" class="act" title="Edit"><i class="la la-edit"></i> Edit</a> ';
           }
           if($this->aud()){
               $delete = '<a href="#" data-uuid="'.$query->uuid.'" data-toggle="modal" data-target="#modal-form-hapus-budayabaca" title="Hapus" class="act"><i class="la la-trash"></i> Hapus</a> ';
           }
           $action =  $edit."".$delete;
           if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

           return $action;
       })
       ->rawColumns(['judul', 'action'])
       ->addIndexColumn()
       ->make(true);
    }

    function get_data_budayabaca($uuid){
       $record = DB::table('budayabaca as a')->select('uuid','judul')->where('uuid', $uuid)->first();
       if($record){
           return response()->json($record);
       }else{
           return -1;
       }
    }

    function new_budayabaca(){
       if (!Session::has('session_upload_gambar_budayabaca')){
           Session::put('session_upload_gambar_budayabaca', $this->GenUuid());
       }        
       return view("backend.budayabaca.new");
    }

    function insert_budayabaca(Request $r){
       $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
       if(!$validator->fails()){
           $tgl_posting= $r->tgl_posting;
           $isi = $r->isi;
           $judul = $r->judul;
           $uuid= $this->GenUuid();
           $record = array(
               "judul"=>$judul,
               "isi"=>$isi,
               "tgl_posting"=>$tgl_posting,
               "created_at"=>date("Y-m-d H:i:s"),
               "create_by"=>Auth::user()->username,
               "updated_at"=>date("Y-m-d H:i:s"),
               "update_by"=>Auth::user()->username,
               "uuid"=>$uuid
           );
           $r->session()->forget('session_upload_gambar_budayabaca');
           DB::table('budayabaca')->insert($record);
           $id_budayabaca = DB::table('budayabaca')->where('uuid', $uuid)->first()->id_budayabaca;
           $id_gambar = $r->id_gambar;
           DB::table('gambar_budayabaca')->where('id_budayabaca', $id_budayabaca)->delete();
           if (count($id_gambar)){
               foreach($id_gambar as $id){
                   $record = array("id_gambar"=>$id, 'id_budayabaca'=>$id_budayabaca);
                   DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                   DB::table('gambar_budayabaca')->insert($record);
               }
           }
           return redirect('backend/halaman-budayabaca')->with('success', 'Budaya Baca Berhasil Ditambahkan');
       }else{

       }
    }

    function update_budayabaca(Request $r){
       $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
       if(!$validator->fails()){
           $tgl_posting= $r->tgl_posting;
           $isi = $r->isi;
           $judul = $r->judul;
           $uuid= $r->uuid;
           $record = array(
               "judul"=>$judul,
               "isi"=>$isi,
               "tgl_posting"=>$tgl_posting,
               "updated_at"=>date("Y-m-d H:i:s"),
               "update_by"=>Auth::user()->username,
           );
           $r->session()->forget('session_upload_gambar_budayabaca');
           DB::table('budayabaca')->where('uuid', $uuid)->update($record);
           $id_budayabaca = DB::table('budayabaca')->where('uuid', $uuid)->first()->id_budayabaca;
           $id_gambar = $r->id_gambar;
           DB::table('gambar_budayabaca')->where('id_budayabaca', $id_budayabaca)->delete();
           if (count($id_gambar)){
               foreach($id_gambar as $id){
                   $record = array("id_gambar"=>$id, 'id_budayabaca'=>$id_budayabaca);
                   DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                   DB::table('gambar_budayabaca')->insert($record);
               }
           }
           return redirect('backend/halaman-budayabaca')->with('success', 'Budaya Baca Berhasil Disimpan');
       }else{

       }
    }

    function delete_budayabaca(Request $r){
       if(!$this->aud()){
           $respon = array('status'=>false,'message'=>'Akses Ditolak!');
           return response()->json($respon);
       }
       $respon = array('status'=>true,'message'=>'Budaya Baca Berhasil Dihapus!');
       DB::table('budayabaca')->where('uuid',$r->uuid)->delete();          
       return response()->json($respon);
    }

    function upload_gambar_budayabaca(Request $request){
       if (!Session::has('session_upload_gambar_budayabaca')){
           $session = $this->GenUuid();
       }else{
           $session = Session::get('session_upload_gambar_budayabaca');
       }        

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

                   Image::make($file)->resize(720,null, function ($constraint) {
                       $constraint->aspectRatio();
                   })->save($filename);
                   Image::make($file)->resize(400,null, function ($constraint) {
                       $constraint->aspectRatio();
                   })->save($thumbs);

                   $img = Image::make($thumbs);
                   $img->crop(400, 300);
                   $img->save();
               
                   Storage::disk('public')->delete("upload/gambar/".$fileupload);
                   Storage::disk('public')->delete("upload/gambar/thumb-".$fileupload_thumbs);
                   
                   $record = array(
                       "id_gambar"=>$random, 
                       "session"=>$session, 
                       "caption"=>$request->caption, 
                       "filename"=>$filename,
                       "thumbs"=>$thumbs,
                       "create_by"=>Auth::user()->username,
                       "created_at"=>date("Y-m-d H:i:s")
                   );

                   DB::table('gambar')->insert($record);
                   return  response()->json(['status' => true,'message'=>"Gambar Berhasil Diupload!"]);
           }
          
       }        
       
       return  response()->json(['status' => false,'message'=>"Terjadi Kesalahan, Gagal Upload Gambar!"]);
    }






    function indexManajemen(){
        return view("backend.manajemen.index");
    }

    function edit_manajemen($uuid){
       $manajemen = DB::table('manajemen')->where('uuid', $uuid)->first();
       if (!Session::has('session_upload_gambar_manajemen')){
           Session::put('session_upload_gambar_manajemen', $uuid);
       } 
       return view("backend.manajemen.edit", compact('manajemen'));
    }

    function view_manajemen($uuid){
       $manajemen = DB::table('manajemen')->where('uuid', $uuid)->first();
       $id_manajemen = $manajemen->id_manajemen;
       $gambar = DB::select("select a.* from gambar as a, gambar_manajemen as b where a.id_gambar = b.id_gambar and b.id_manajemen = $id_manajemen order by b.id_gambar_manajemen asc");
       return view("backend.manajemen.view", compact('manajemen','gambar'));
    }

    function dt_manajemen(){
       $query = DB::table('manajemen as a')
       ->select('a.id_manajemen as id_manajemen','a.judul as judul','a.uuid',
           'a.tgl_posting', 'a.create_by');

       return Datatables::of($query)
       ->editColumn('judul', function ($query) {

           return '<a href="'.url('backend/halaman-manajemen/view/'.$query->uuid).'" >'.$query->judul.'</a> ';
           //return $action;
       })
       ->addColumn('action', function ($query) {

           $edit = ""; $delete = "";
           if($this->auu()){
               $edit = '<a href="'.url('backend/halaman-manajemen/edit/'.$query->uuid).'" class="act" title="Edit"><i class="la la-edit"></i> Edit</a> ';
           }
           if($this->aud()){
               $delete = '<a href="#" data-uuid="'.$query->uuid.'" data-toggle="modal" data-target="#modal-form-hapus-manajemen" title="Hapus" class="act"><i class="la la-trash"></i> Hapus</a> ';
           }
           $action =  $edit."".$delete;
           if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

           return $action;
       })
       ->rawColumns(['judul', 'action'])
       ->addIndexColumn()
       ->make(true);
    }

    function get_data_manajemen($uuid){
       $record = DB::table('manajemen as a')->select('uuid','judul')->where('uuid', $uuid)->first();
       if($record){
           return response()->json($record);
       }else{
           return -1;
       }
    }

    function new_manajemen(){
       if (!Session::has('session_upload_gambar_manajemen')){
           Session::put('session_upload_gambar_manajemen', $this->GenUuid());
       }        
       return view("backend.manajemen.new");
    }

    function insert_manajemen(Request $r){
       $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
       if(!$validator->fails()){
           $tgl_posting= $r->tgl_posting;
           $isi = $r->isi;
           $judul = $r->judul;
           $uuid= $this->GenUuid();
           $record = array(
               "judul"=>$judul,
               "isi"=>$isi,
               "tgl_posting"=>$tgl_posting,
               "created_at"=>date("Y-m-d H:i:s"),
               "create_by"=>Auth::user()->username,
               "updated_at"=>date("Y-m-d H:i:s"),
               "update_by"=>Auth::user()->username,
               "uuid"=>$uuid
           );
           $r->session()->forget('session_upload_gambar_manajemen');
           DB::table('manajemen')->insert($record);
           $id_manajemen = DB::table('manajemen')->where('uuid', $uuid)->first()->id_manajemen;
           $id_gambar = $r->id_gambar;
           DB::table('gambar_manajemen')->where('id_manajemen', $id_manajemen)->delete();
           if (count($id_gambar)){
               foreach($id_gambar as $id){
                   $record = array("id_gambar"=>$id, 'id_manajemen'=>$id_manajemen);
                   DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                   DB::table('gambar_manajemen')->insert($record);
               }
           }
           return redirect('backend/halaman-manajemen')->with('success', 'Manajemen Sekolah Berhasil Ditambahkan');
       }else{

       }
    }

    function update_manajemen(Request $r){
       $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
       if(!$validator->fails()){
           $tgl_posting= $r->tgl_posting;
           $isi = $r->isi;
           $judul = $r->judul;
           $uuid= $r->uuid;
           $record = array(
               "judul"=>$judul,
               "isi"=>$isi,
               "tgl_posting"=>$tgl_posting,
               "updated_at"=>date("Y-m-d H:i:s"),
               "update_by"=>Auth::user()->username,
           );
           $r->session()->forget('session_upload_gambar_manajemen');
           DB::table('manajemen')->where('uuid', $uuid)->update($record);
           $id_manajemen = DB::table('manajemen')->where('uuid', $uuid)->first()->id_manajemen;
           $id_gambar = $r->id_gambar;
           DB::table('gambar_manajemen')->where('id_manajemen', $id_manajemen)->delete();
           if (count($id_gambar)){
               foreach($id_gambar as $id){
                   $record = array("id_gambar"=>$id, 'id_manajemen'=>$id_manajemen);
                   DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                   DB::table('gambar_manajemen')->insert($record);
               }
           }
           return redirect('backend/halaman-manajemen')->with('success', 'Manajemen Sekolah Berhasil Disimpan');
       }else{

       }
    }

    function delete_manajemen(Request $r){
       if(!$this->aud()){
           $respon = array('status'=>false,'message'=>'Akses Ditolak!');
           return response()->json($respon);
       }
       $respon = array('status'=>true,'message'=>'Manajemen Sekolah Berhasil Dihapus!');
       DB::table('manajemen')->where('uuid',$r->uuid)->delete();          
       return response()->json($respon);
    }

    function upload_gambar_manajemen(Request $request){
       if (!Session::has('session_upload_gambar_manajemen')){
           $session = $this->GenUuid();
       }else{
           $session = Session::get('session_upload_gambar_manajemen');
       }        

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

                   Image::make($file)->resize(720,null, function ($constraint) {
                       $constraint->aspectRatio();
                   })->save($filename);
                   Image::make($file)->resize(400,null, function ($constraint) {
                       $constraint->aspectRatio();
                   })->save($thumbs);

                   $img = Image::make($thumbs);
                   $img->crop(400, 300);
                   $img->save();
               
                   Storage::disk('public')->delete("upload/gambar/".$fileupload);
                   Storage::disk('public')->delete("upload/gambar/thumb-".$fileupload_thumbs);
                   
                   $record = array(
                       "id_gambar"=>$random, 
                       "session"=>$session, 
                       "caption"=>$request->caption, 
                       "filename"=>$filename,
                       "thumbs"=>$thumbs,
                       "create_by"=>Auth::user()->username,
                       "created_at"=>date("Y-m-d H:i:s")
                   );

                   DB::table('gambar')->insert($record);
                   return  response()->json(['status' => true,'message'=>"Gambar Berhasil Diupload!"]);
           }
          
       }        
       
       return  response()->json(['status' => false,'message'=>"Terjadi Kesalahan, Gagal Upload Gambar!"]);
    }





    function indexParenting(){
        return view("backend.parenting.index");
    }

    function edit_parenting($uuid){
       $parenting = DB::table('parenting')->where('uuid', $uuid)->first();
       if (!Session::has('session_upload_gambar_parenting')){
           Session::put('session_upload_gambar_parenting', $uuid);
       } 
       return view("backend.parenting.edit", compact('parenting'));
    }

    function view_parenting($uuid){
       $parenting = DB::table('parenting')->where('uuid', $uuid)->first();
       $id_parenting = $parenting->id_parenting;
       $gambar = DB::select("select a.* from gambar as a, gambar_parenting as b where a.id_gambar = b.id_gambar and b.id_parenting = $id_parenting order by b.id_gambar_parenting asc");
       return view("backend.parenting.view", compact('parenting','gambar'));
    }

    function dt_parenting(){
       $query = DB::table('parenting as a')
       ->select('a.id_parenting as id_parenting','a.judul as judul','a.uuid',
           'a.tgl_posting', 'a.create_by');

       return Datatables::of($query)
       ->editColumn('judul', function ($query) {

           return '<a href="'.url('backend/halaman-parenting/view/'.$query->uuid).'" >'.$query->judul.'</a> ';
           //return $action;
       })
       ->addColumn('action', function ($query) {

           $edit = ""; $delete = "";
           if($this->auu()){
               $edit = '<a href="'.url('backend/halaman-parenting/edit/'.$query->uuid).'" class="act" title="Edit"><i class="la la-edit"></i> Edit</a> ';
           }
           if($this->aud()){
               $delete = '<a href="#" data-uuid="'.$query->uuid.'" data-toggle="modal" data-target="#modal-form-hapus-parenting" title="Hapus" class="act"><i class="la la-trash"></i> Hapus</a> ';
           }
           $action =  $edit."".$delete;
           if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

           return $action;
       })
       ->rawColumns(['judul', 'action'])
       ->addIndexColumn()
       ->make(true);
    }

    function get_data_parenting($uuid){
       $record = DB::table('parenting as a')->select('uuid','judul')->where('uuid', $uuid)->first();
       if($record){
           return response()->json($record);
       }else{
           return -1;
       }
    }

    function new_parenting(){
       if (!Session::has('session_upload_gambar_parenting')){
           Session::put('session_upload_gambar_parenting', $this->GenUuid());
       }        
       return view("backend.parenting.new");
    }

    function insert_parenting(Request $r){
       $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
       if(!$validator->fails()){
           $tgl_posting= $r->tgl_posting;
           $isi = $r->isi;
           $judul = $r->judul;
           $uuid= $this->GenUuid();
           $record = array(
               "judul"=>$judul,
               "isi"=>$isi,
               "tgl_posting"=>$tgl_posting,
               "created_at"=>date("Y-m-d H:i:s"),
               "create_by"=>Auth::user()->username,
               "updated_at"=>date("Y-m-d H:i:s"),
               "update_by"=>Auth::user()->username,
               "uuid"=>$uuid
           );
           $r->session()->forget('session_upload_gambar_parenting');
           DB::table('parenting')->insert($record);
           $id_parenting = DB::table('parenting')->where('uuid', $uuid)->first()->id_parenting;
           $id_gambar = $r->id_gambar;
           DB::table('gambar_parenting')->where('id_parenting', $id_parenting)->delete();
           if (count($id_gambar)){
               foreach($id_gambar as $id){
                   $record = array("id_gambar"=>$id, 'id_parenting'=>$id_parenting);
                   DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                   DB::table('gambar_parenting')->insert($record);
               }
           }
           return redirect('backend/halaman-parenting')->with('success', 'Parenting Berhasil Ditambahkan');
       }else{

       }
    }

    function update_parenting(Request $r){
       $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
       if(!$validator->fails()){
           $tgl_posting= $r->tgl_posting;
           $isi = $r->isi;
           $judul = $r->judul;
           $uuid= $r->uuid;
           $record = array(
               "judul"=>$judul,
               "isi"=>$isi,
               "tgl_posting"=>$tgl_posting,
               "updated_at"=>date("Y-m-d H:i:s"),
               "update_by"=>Auth::user()->username,
           );
           $r->session()->forget('session_upload_gambar_parenting');
           DB::table('parenting')->where('uuid', $uuid)->update($record);
           $id_parenting = DB::table('parenting')->where('uuid', $uuid)->first()->id_parenting;
           $id_gambar = $r->id_gambar;
           DB::table('gambar_parenting')->where('id_parenting', $id_parenting)->delete();
           if (count($id_gambar)){
               foreach($id_gambar as $id){
                   $record = array("id_gambar"=>$id, 'id_parenting'=>$id_parenting);
                   DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                   DB::table('gambar_parenting')->insert($record);
               }
           }
           return redirect('backend/halaman-parenting')->with('success', 'Parenting Berhasil Disimpan');
       }else{

       }
    }

    function delete_parenting(Request $r){
       if(!$this->aud()){
           $respon = array('status'=>false,'message'=>'Akses Ditolak!');
           return response()->json($respon);
       }
       $respon = array('status'=>true,'message'=>'Parenting Berhasil Dihapus!');
       DB::table('parenting')->where('uuid',$r->uuid)->delete();          
       return response()->json($respon);
    }

    function upload_gambar_parenting(Request $request){
       if (!Session::has('session_upload_gambar_parenting')){
           $session = $this->GenUuid();
       }else{
           $session = Session::get('session_upload_gambar_parenting');
       }        

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

                   Image::make($file)->resize(720,null, function ($constraint) {
                       $constraint->aspectRatio();
                   })->save($filename);
                   Image::make($file)->resize(400,null, function ($constraint) {
                       $constraint->aspectRatio();
                   })->save($thumbs);

                   $img = Image::make($thumbs);
                   $img->crop(400, 300);
                   $img->save();
               
                   Storage::disk('public')->delete("upload/gambar/".$fileupload);
                   Storage::disk('public')->delete("upload/gambar/thumb-".$fileupload_thumbs);
                   
                   $record = array(
                       "id_gambar"=>$random, 
                       "session"=>$session, 
                       "caption"=>$request->caption, 
                       "filename"=>$filename,
                       "thumbs"=>$thumbs,
                       "create_by"=>Auth::user()->username,
                       "created_at"=>date("Y-m-d H:i:s")
                   );

                   DB::table('gambar')->insert($record);
                   return  response()->json(['status' => true,'message'=>"Gambar Berhasil Diupload!"]);
           }
          
       }        
       
       return  response()->json(['status' => false,'message'=>"Terjadi Kesalahan, Gagal Upload Gambar!"]);
    }


    function indexLiterasi(){
        return view("backend.literasi.index");
    }

    function edit_literasi($uuid){
       $literasi = DB::table('literasi')->where('uuid', $uuid)->first();
       if (!Session::has('session_upload_gambar_literasi')){
           Session::put('session_upload_gambar_literasi', $uuid);
       } 
       return view("backend.literasi.edit", compact('literasi'));
    }

    function view_literasi($uuid){
       $literasi = DB::table('literasi')->where('uuid', $uuid)->first();
       $id_literasi = $literasi->id_literasi;
       $gambar = DB::select("select a.* from gambar as a, gambar_literasi as b where a.id_gambar = b.id_gambar and b.id_literasi = $id_literasi order by b.id_gambar_literasi asc");
       return view("backend.literasi.view", compact('literasi','gambar'));
    }

    function dt_literasi(){
       $query = DB::table('literasi as a')
       ->select('a.id_literasi as id_literasi','a.judul as judul','a.uuid',
           'a.tgl_posting', 'a.create_by');

       return Datatables::of($query)
       ->editColumn('judul', function ($query) {

           return '<a href="'.url('backend/halaman-literasi/view/'.$query->uuid).'" >'.$query->judul.'</a> ';
           //return $action;
       })
       ->addColumn('action', function ($query) {

           $edit = ""; $delete = "";
           if($this->auu()){
               $edit = '<a href="'.url('backend/halaman-literasi/edit/'.$query->uuid).'" class="act" title="Edit"><i class="la la-edit"></i> Edit</a> ';
           }
           if($this->aud()){
               $delete = '<a href="#" data-uuid="'.$query->uuid.'" data-toggle="modal" data-target="#modal-form-hapus-literasi" title="Hapus" class="act"><i class="la la-trash"></i> Hapus</a> ';
           }
           $action =  $edit."".$delete;
           if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

           return $action;
       })
       ->rawColumns(['judul', 'action'])
       ->addIndexColumn()
       ->make(true);
    }

    function get_data_literasi($uuid){
       $record = DB::table('literasi as a')->select('uuid','judul')->where('uuid', $uuid)->first();
       if($record){
           return response()->json($record);
       }else{
           return -1;
       }
    }

    function new_literasi(){
       if (!Session::has('session_upload_gambar_literasi')){
           Session::put('session_upload_gambar_literasi', $this->GenUuid());
       }        
       return view("backend.literasi.new");
    }

    function insert_literasi(Request $r){
       $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
       if(!$validator->fails()){
           $tgl_posting= $r->tgl_posting;
           $isi = $r->isi;
           $judul = $r->judul;
           $uuid= $this->GenUuid();
           $record = array(
               "judul"=>$judul,
               "isi"=>$isi,
               "tgl_posting"=>$tgl_posting,
               "created_at"=>date("Y-m-d H:i:s"),
               "create_by"=>Auth::user()->username,
               "updated_at"=>date("Y-m-d H:i:s"),
               "update_by"=>Auth::user()->username,
               "uuid"=>$uuid
           );
           $r->session()->forget('session_upload_gambar_literasi');
           DB::table('literasi')->insert($record);
           $id_literasi = DB::table('literasi')->where('uuid', $uuid)->first()->id_literasi;
           $id_gambar = $r->id_gambar;
           DB::table('gambar_literasi')->where('id_literasi', $id_literasi)->delete();
           if (count($id_gambar)){
               foreach($id_gambar as $id){
                   $record = array("id_gambar"=>$id, 'id_literasi'=>$id_literasi);
                   DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                   DB::table('gambar_literasi')->insert($record);
               }
           }
           return redirect('backend/halaman-literasi')->with('success', 'Literasi Berhasil Ditambahkan');
       }else{

       }
    }

    function update_literasi(Request $r){
       $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
       if(!$validator->fails()){
           $tgl_posting= $r->tgl_posting;
           $isi = $r->isi;
           $judul = $r->judul;
           $uuid= $r->uuid;
           $record = array(
               "judul"=>$judul,
               "isi"=>$isi,
               "tgl_posting"=>$tgl_posting,
               "updated_at"=>date("Y-m-d H:i:s"),
               "update_by"=>Auth::user()->username,
           );
           $r->session()->forget('session_upload_gambar_literasi');
           DB::table('literasi')->where('uuid', $uuid)->update($record);
           $id_literasi = DB::table('literasi')->where('uuid', $uuid)->first()->id_literasi;
           $id_gambar = $r->id_gambar;
           DB::table('gambar_literasi')->where('id_literasi', $id_literasi)->delete();
           if (count($id_gambar)){
               foreach($id_gambar as $id){
                   $record = array("id_gambar"=>$id, 'id_literasi'=>$id_literasi);
                   DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                   DB::table('gambar_literasi')->insert($record);
               }
           }
           return redirect('backend/halaman-literasi')->with('success', 'Literasi Berhasil Disimpan');
       }else{

       }
    }

    function delete_literasi(Request $r){
       if(!$this->aud()){
           $respon = array('status'=>false,'message'=>'Akses Ditolak!');
           return response()->json($respon);
       }
       $respon = array('status'=>true,'message'=>'Literasi Berhasil Dihapus!');
       DB::table('literasi')->where('uuid',$r->uuid)->delete();          
       return response()->json($respon);
    }

    function upload_gambar_literasi(Request $request){
       if (!Session::has('session_upload_gambar_literasi')){
           $session = $this->GenUuid();
       }else{
           $session = Session::get('session_upload_gambar_literasi');
       }        

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

                   Image::make($file)->resize(720,null, function ($constraint) {
                       $constraint->aspectRatio();
                   })->save($filename);
                   Image::make($file)->resize(400,null, function ($constraint) {
                       $constraint->aspectRatio();
                   })->save($thumbs);

                   $img = Image::make($thumbs);
                   $img->crop(400, 300);
                   $img->save();
               
                   Storage::disk('public')->delete("upload/gambar/".$fileupload);
                   Storage::disk('public')->delete("upload/gambar/thumb-".$fileupload_thumbs);
                   
                   $record = array(
                       "id_gambar"=>$random, 
                       "session"=>$session, 
                       "caption"=>$request->caption, 
                       "filename"=>$filename,
                       "thumbs"=>$thumbs,
                       "create_by"=>Auth::user()->username,
                       "created_at"=>date("Y-m-d H:i:s")
                   );

                   DB::table('gambar')->insert($record);
                   return  response()->json(['status' => true,'message'=>"Gambar Berhasil Diupload!"]);
           }
          
       }        
       
       return  response()->json(['status' => false,'message'=>"Terjadi Kesalahan, Gagal Upload Gambar!"]);
    }


    function indexInspiratif(){
        return view("backend.inspiratif.index");
    }

    function edit_inspiratif($uuid){
       $inspiratif = DB::table('inspiratif')->where('uuid', $uuid)->first();
       if (!Session::has('session_upload_gambar_inspiratif')){
           Session::put('session_upload_gambar_inspiratif', $uuid);
       } 
       return view("backend.inspiratif.edit", compact('inspiratif'));
    }

    function view_inspiratif($uuid){
       $inspiratif = DB::table('inspiratif')->where('uuid', $uuid)->first();
       $id_inspiratif = $inspiratif->id_inspiratif;
       $gambar = DB::select("select a.* from gambar as a, gambar_inspiratif as b where a.id_gambar = b.id_gambar and b.id_inspiratif = $id_inspiratif order by b.id_gambar_inspiratif asc");
       return view("backend.inspiratif.view", compact('inspiratif','gambar'));
    }

    function dt_inspiratif(){
       $query = DB::table('inspiratif as a')
       ->select('a.id_inspiratif as id_inspiratif','a.judul as judul','a.uuid',
           'a.tgl_posting', 'a.create_by');

       return Datatables::of($query)
       ->editColumn('judul', function ($query) {

           return '<a href="'.url('backend/halaman-inspiratif/view/'.$query->uuid).'" >'.$query->judul.'</a> ';
           //return $action;
       })
       ->addColumn('action', function ($query) {

           $edit = ""; $delete = "";
           if($this->auu()){
               $edit = '<a href="'.url('backend/halaman-inspiratif/edit/'.$query->uuid).'" class="act" title="Edit"><i class="la la-edit"></i> Edit</a> ';
           }
           if($this->aud()){
               $delete = '<a href="#" data-uuid="'.$query->uuid.'" data-toggle="modal" data-target="#modal-form-hapus-inspiratif" title="Hapus" class="act"><i class="la la-trash"></i> Hapus</a> ';
           }
           $action =  $edit."".$delete;
           if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

           return $action;
       })
       ->rawColumns(['judul', 'action'])
       ->addIndexColumn()
       ->make(true);
    }

    function get_data_inspiratif($uuid){
       $record = DB::table('inspiratif as a')->select('uuid','judul')->where('uuid', $uuid)->first();
       if($record){
           return response()->json($record);
       }else{
           return -1;
       }
    }

    function new_inspiratif(){
       if (!Session::has('session_upload_gambar_inspiratif')){
           Session::put('session_upload_gambar_inspiratif', $this->GenUuid());
       }        
       return view("backend.inspiratif.new");
    }

    function insert_inspiratif(Request $r){
       $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
       if(!$validator->fails()){
           $tgl_posting= $r->tgl_posting;
           $isi = $r->isi;
           $judul = $r->judul;
           $uuid= $this->GenUuid();
           $record = array(
               "judul"=>$judul,
               "isi"=>$isi,
               "tgl_posting"=>$tgl_posting,
               "created_at"=>date("Y-m-d H:i:s"),
               "create_by"=>Auth::user()->username,
               "updated_at"=>date("Y-m-d H:i:s"),
               "update_by"=>Auth::user()->username,
               "uuid"=>$uuid
           );
           $r->session()->forget('session_upload_gambar_inspiratif');
           DB::table('inspiratif')->insert($record);
           $id_inspiratif = DB::table('inspiratif')->where('uuid', $uuid)->first()->id_inspiratif;
           $id_gambar = $r->id_gambar;
           DB::table('gambar_inspiratif')->where('id_inspiratif', $id_inspiratif)->delete();
           if (count($id_gambar)){
               foreach($id_gambar as $id){
                   $record = array("id_gambar"=>$id, 'id_inspiratif'=>$id_inspiratif);
                   DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                   DB::table('gambar_inspiratif')->insert($record);
               }
           }
           return redirect('backend/halaman-inspiratif')->with('success', 'Sosok Inspiratif Berhasil Ditambahkan');
       }else{

       }
    }

    function update_inspiratif(Request $r){
       $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
       if(!$validator->fails()){
           $tgl_posting= $r->tgl_posting;
           $isi = $r->isi;
           $judul = $r->judul;
           $uuid= $r->uuid;
           $record = array(
               "judul"=>$judul,
               "isi"=>$isi,
               "tgl_posting"=>$tgl_posting,
               "updated_at"=>date("Y-m-d H:i:s"),
               "update_by"=>Auth::user()->username,
           );
           $r->session()->forget('session_upload_gambar_inspiratif');
           DB::table('inspiratif')->where('uuid', $uuid)->update($record);
           $id_inspiratif = DB::table('inspiratif')->where('uuid', $uuid)->first()->id_literasi;
           $id_gambar = $r->id_gambar;
           DB::table('gambar_inspiratif')->where('id_inspiratif', $id_inspiratif)->delete();
           if (count($id_gambar)){
               foreach($id_gambar as $id){
                   $record = array("id_gambar"=>$id, 'id_inspiratif'=>$id_inspiratif);
                   DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                   DB::table('gambar_inspiratif')->insert($record);
               }
           }
           return redirect('backend/halaman-inspiratif')->with('success', 'Sosok Inspiratif Berhasil Disimpan');
       }else{

       }
    }

    function delete_inspiratif(Request $r){
       if(!$this->aud()){
           $respon = array('status'=>false,'message'=>'Akses Ditolak!');
           return response()->json($respon);
       }
       $respon = array('status'=>true,'message'=>'Sosok Inspiratif Berhasil Dihapus!');
       DB::table('inspiratif')->where('uuid',$r->uuid)->delete();          
       return response()->json($respon);
    }

    function upload_gambar_inspiratif(Request $request){
       if (!Session::has('session_upload_gambar_inspiratif')){
           $session = $this->GenUuid();
       }else{
           $session = Session::get('session_upload_gambar_inspiratif');
       }        

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

                   Image::make($file)->resize(720,null, function ($constraint) {
                       $constraint->aspectRatio();
                   })->save($filename);
                   Image::make($file)->resize(400,null, function ($constraint) {
                       $constraint->aspectRatio();
                   })->save($thumbs);

                   $img = Image::make($thumbs);
                   $img->crop(400, 300);
                   $img->save();
               
                   Storage::disk('public')->delete("upload/gambar/".$fileupload);
                   Storage::disk('public')->delete("upload/gambar/thumb-".$fileupload_thumbs);
                   
                   $record = array(
                       "id_gambar"=>$random, 
                       "session"=>$session, 
                       "caption"=>$request->caption, 
                       "filename"=>$filename,
                       "thumbs"=>$thumbs,
                       "create_by"=>Auth::user()->username,
                       "created_at"=>date("Y-m-d H:i:s")
                   );

                   DB::table('gambar')->insert($record);
                   return  response()->json(['status' => true,'message'=>"Gambar Berhasil Diupload!"]);
           }
          
       }        
       
       return  response()->json(['status' => false,'message'=>"Terjadi Kesalahan, Gagal Upload Gambar!"]);
    }


     function upload_gambar_halaman(Request $request){
        if (!Session::has('session_upload_gambar_halaman')){
            $session = $this->GenUuid();
        }else{
            $session = Session::get('session_upload_gambar_halaman');
        }        

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

                    Image::make($file)->resize(720,null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($filename);
                    Image::make($file)->resize(400,null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($thumbs);

                    $img = Image::make($thumbs);
                    $img->crop(400, 300);
                    $img->save();
                
                    Storage::disk('public')->delete("upload/gambar/".$fileupload);
                    Storage::disk('public')->delete("upload/gambar/thumb-".$fileupload_thumbs);
                    
                    $record = array(
                        "id_gambar"=>$random, 
                        "session"=>$session, 
                        "caption"=>$request->caption, 
                        "filename"=>$filename,
                        "thumbs"=>$thumbs,
                        "create_by"=>Auth::user()->username,
                        "created_at"=>date("Y-m-d H:i:s")
                    );

                    DB::table('gambar')->insert($record);
                    return  response()->json(['status' => true,'message'=>"Gambar Berhasil Diupload!"]);
            }
           
        }        
        
        return  response()->json(['status' => false,'message'=>"Terjadi Kesalahan, Gagal Upload Gambar!"]);
     }

     function list_gambar_session($session){
        
        $gambar = DB::table('gambar')->where('session', $session)->orderby('created_at','asc')->get();
        return view("backend.gambar.list", compact('gambar'));

     }
 

     function get_detail_gambar($id_gambar){
        $record = DB::table('gambar as a')->where('id_gambar', $id_gambar)->first();
        if($record){
            $record->informasi = "Caption : ".$record->caption;
            $record->thumbs_url = url($record->thumbs);
            return response()->json($record);
        }else{
            return -1;
        }
     }

     function update_caption_gambar(Request $r){
        $id_gambar = $r->id_gambar;
        $respon = array('status'=>true,'message'=>'Data Gambar Berhasil Disimpan!');
        $record = array("caption"=>$r->caption, 
            "updated_at"=>date("Y-m-d H:i:s"), 
            "update_by"=>Auth::user()->username);
        DB::table('gambar')->where('id_gambar',$r->id_gambar)->update($record);      
        return response()->json($respon);
     }

     function delete_gambar(Request $r){
        $id_gambar = $r->id_gambar;
        $gambar = DB::table('gambar')->where('id_gambar', $id_gambar)->first();
        $respon = array('status'=>true,'message'=>'Data Gambar Berhasil Dihapus!');
        DB::table('gambar')->where('id_gambar',$r->id_gambar)->delete();   

        File::delete($gambar->filename);
        File::delete($gambar->thumbs);   
        return response()->json($respon);  
     }


     function indexHalaman(){
        return view("backend.halaman.index");
     }

     function edit_halaman($uuid){
        $halaman = DB::table('halaman')->where('uuid', $uuid)->first();
        if (!Session::has('session_upload_gambar_halaman')){
            Session::put('session_upload_gambar_halaman', $uuid);
        } 
        return view("backend.halaman.edit", compact('halaman'));
     }

     function view_halaman($uuid){
        $halaman = DB::table('halaman')->where('uuid', $uuid)->first();
        $id_halaman = $halaman->id_halaman;
        $gambar = DB::select("select a.* from gambar as a, gambar_halaman as b where a.id_gambar = b.id_gambar and b.id_halaman = $id_halaman order by b.id_gambar_halaman asc");
        return view("backend.halaman.view", compact('halaman','gambar'));
     }

     function dt_halaman(){
        $query = DB::table('halaman as a')
        ->select('a.id_halaman as id_halaman','a.judul as judul','a.uuid',
            'a.created_at', 'a.create_by');

        return Datatables::of($query)
        ->editColumn('judul', function ($query) {

            return '<a href="'.url('backend/halaman-statis/view/'.$query->uuid).'" >'.$query->judul.'</a> ';
            //return $action;
        })
        ->addColumn('action', function ($query) {

            $edit = ""; $delete = "";
            if($this->auu()){
                $edit = '<a href="'.url('backend/halaman-statis/edit/'.$query->uuid).'" class="act" title="Edit"><i class="la la-edit"></i> Edit</a> ';
            }
            if($this->aud()){
                $delete = '<a href="#" data-uuid="'.$query->uuid.'" data-toggle="modal" data-target="#modal-form-hapus-halaman" title="Hapus" class="act"><i class="la la-trash"></i> Hapus</a> ';
            }
            $action =  $edit."".$delete;
            if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

            return $action;
        })
        ->rawColumns(['judul', 'action'])
        ->addIndexColumn()
        ->make(true);
     }

     function get_data_halaman($uuid){
        $record = DB::table('halaman as a')->select('uuid','judul')->where('uuid', $uuid)->first();
        if($record){
            return response()->json($record);
        }else{
            return -1;
        }
     }

     function new_halaman(){
        if (!Session::has('session_upload_gambar_halaman')){
            Session::put('session_upload_gambar_halaman', $this->GenUuid());
        }        
        return view("backend.halaman.new");
     }

     function insert_halaman(Request $r){
        $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
        if(!$validator->fails()){
            $tgl_posting= $r->tgl_posting;
            $isi = $r->isi;
            $judul = $r->judul;
            $uuid= $this->GenUuid();
            $record = array(
                "judul"=>$judul,
                "isi"=>$isi,
                "created_at"=>date("Y-m-d H:i:s"),
                "create_by"=>Auth::user()->username,
                "updated_at"=>date("Y-m-d H:i:s"),
                "update_by"=>Auth::user()->username,
                "uuid"=>$uuid
            );
            $r->session()->forget('session_upload_gambar_halaman');
            DB::table('halaman')->insert($record);
            $id_halaman = DB::table('halaman')->where('uuid', $uuid)->first()->id_halaman;
            // $id_gambar = $r->id_gambar;
            // DB::table('gambar_halaman')->where('id_halaman', $id_halaman)->delete();
            // if (count($id_gambar)){
            //     foreach($id_gambar as $id){
            //         $record = array("id_gambar"=>$id, 'id_halaman'=>$id_halaman);
            //         DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
            //         DB::table('gambar_halaman')->insert($record);
            //     }
            // }
            return redirect('backend/halaman-statis')->with('success', 'Halaman Statis Berhasil Ditambahkan');
        }else{

        }
     }

     function update_halaman(Request $r){
        $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
        if(!$validator->fails()){
           // $tgl_posting= $r->tgl_posting;
            $isi = $r->isi;
            $judul = $r->judul;
            $uuid= $r->uuid;
            $record = array(
                "judul"=>$judul,
                "isi"=>$isi,
                "updated_at"=>date("Y-m-d H:i:s"),
                "update_by"=>Auth::user()->username,
            );
            $r->session()->forget('session_upload_gambar_halaman');
            DB::table('halaman')->where('uuid', $uuid)->update($record);
            $id_halaman = DB::table('halaman')->where('uuid', $uuid)->first()->id_halaman;
            // $id_gambar = $r->id_gambar;
            // DB::table('gambar_halaman')->where('id_halaman', $id_halaman)->delete();
            // if (count($id_gambar)){
            //     foreach($id_gambar as $id){
            //         $record = array("id_gambar"=>$id, 'id_halaman'=>$id_halaman);
            //         DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
            //         DB::table('gambar_halaman')->insert($record);
            //     }
            // }
            return redirect('backend/halaman-statis')->with('success', 'Halaman Statis Berhasil Disimpan');
        }else{

        }
     }

     function delete_halaman(Request $r){
        if(!$this->aud()){
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
            return response()->json($respon);
        }
        $respon = array('status'=>true,'message'=>'Halaman Statis Berhasil Dihapus!');
        DB::table('halaman')->where('uuid',$r->uuid)->delete();          
        return response()->json($respon);
     }

     function indexLoker(){
        return view("backend.loker.index");
     }

     function new_loker(){
        if (!Session::has('session_upload_gambar_loker')){
            Session::put('session_upload_gambar_loker',$this->GenUuid());
        }
        return view("backend.loker.new");
     }

     function view_loker($uuid){
        $loker = DB::table('loker')->where('uuid', $uuid)->first();
        $id_loker = $loker->id_loker;
        $gambar = DB::select("select a.* from gambar as a, gambar_loker as b where a.id_gambar = b.id_gambar and b.id_loker = $id_loker order by b.id_gambar_loker asc");
        return view("backend.loker.view", compact('loker','gambar'));
     }

     function insert_loker(Request $r){
        $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
        if(!$validator->fails()){
            $tgl_posting= $r->tgl_posting;
            $isi = $r->isi;
            $judul = $r->judul;
            $uuid= $this->GenUuid();
            $record = array(
                "judul"=>$judul,
                "isi"=>$isi,
                "tgl_posting"=>$tgl_posting,
                "created_at"=>date("Y-m-d H:i:s"),
                "create_by"=>Auth::user()->username,
                "updated_at"=>date("Y-m-d H:i:s"),
                "update_by"=>Auth::user()->username,
                "uuid"=>$uuid
            );
            $r->session()->forget('session_upload_gambar_loker');
            DB::table('loker')->insert($record);
            $id_loker = DB::table('loker')->where('uuid', $uuid)->first()->id_loker;
            $id_gambar = $r->id_gambar;
            DB::table('gambar_loker')->where('id_loker', $id_loker)->delete();
            if (count($id_gambar)){
                foreach($id_gambar as $id){
                    $record = array("id_gambar"=>$id, 'id_loker'=>$id_loker);
                    DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                    DB::table('gambar_loker')->insert($record);
                }
            }
            return redirect('backend/loker')->with('success', 'Lowongan Kerja Berhasil Ditambahkan');
        }else{

        }

     }

     function edit_loker($uuid){

        $loker = DB::table('loker')->where('uuid', $uuid)->first();
        if (!Session::has('session_upload_gambar_loker')){
            Session::put('session_upload_gambar_loker', $uuid);
        } 
        return view("backend.loker.edit", compact('loker'));

     }

     function upload_gambar_loker(Request $request){
        if (!Session::has('session_upload_gambar_loker')){
            $session = $this->GenUuid();
        }else{
            $session = Session::get('session_upload_gambar_loker');
        }        

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

                    Image::make($file)->resize(720,null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($filename);
                    Image::make($file)->resize(400,null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($thumbs);

                    $img = Image::make($thumbs);
                    $img->crop(400, 300);
                    $img->save();
                
                    Storage::disk('public')->delete("upload/gambar/".$fileupload);
                    Storage::disk('public')->delete("upload/gambar/thumb-".$fileupload_thumbs);
                    
                    $record = array(
                        "id_gambar"=>$random, 
                        "session"=>$session, 
                        "caption"=>$request->caption, 
                        "filename"=>$filename,
                        "thumbs"=>$thumbs,
                        "create_by"=>Auth::user()->username,
                        "created_at"=>date("Y-m-d H:i:s")
                    );

                    DB::table('gambar')->insert($record);
                    return  response()->json(['status' => true,'message'=>"Gambar Berhasil Diupload!"]);
            }
           
        }        
        
        return  response()->json(['status' => false,'message'=>"Terjadi Kesalahan, Gagal Upload Gambar!"]);
     }

     function dt_loker(){

        $query = DB::table('loker as a')
        ->select('a.id_loker as id_loker','a.judul as judul','a.uuid',
            'a.tgl_posting', 'a.create_by');

        return Datatables::of($query)
        ->editColumn('judul', function ($query) {

            return '<a href="'.url('backend/loker/view/'.$query->uuid).'" >'.$query->judul.'</a> ';
            //return $action;
        })
        ->addColumn('action', function ($query) {

            $edit = ""; $delete = "";
            if($this->auu()){
                $edit = '<a href="'.url('backend/loker/edit/'.$query->uuid).'" class="act" title="Edit"><i class="la la-edit"></i> Edit</a> ';
            }
            if($this->aud()){
                $delete = '<a href="#" data-uuid="'.$query->uuid.'" data-toggle="modal" data-target="#modal-form-hapus-loker" title="Hapus" class="act"><i class="la la-trash"></i> Hapus</a> ';
            }
            $action =  $edit."".$delete;
            if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

            return $action;
        })
        ->rawColumns(['judul', 'action'])
        ->addIndexColumn()
        ->make(true);

     }

     function update_loker(Request $r){
        $validator = Validator::make($r->all(), ['judul' => 'required','isi'=>'required']);
        if(!$validator->fails()){
            $tgl_posting= $r->tgl_posting;
            $isi = $r->isi;
            $judul = $r->judul;
            $uuid= $r->uuid;
            $record = array(
                "judul"=>$judul,
                "isi"=>$isi,
                "tgl_posting"=>$tgl_posting,
                "updated_at"=>date("Y-m-d H:i:s"),
                "update_by"=>Auth::user()->username,
            );
            $r->session()->forget('session_upload_gambar_loker');
            DB::table('loker')->where('uuid', $uuid)->update($record);
            $id_loker = DB::table('loker')->where('uuid', $uuid)->first()->id_loker;
            $id_gambar = $r->id_gambar;
            DB::table('gambar_loker')->where('id_loker', $id_loker)->delete();
            if (count($id_gambar)){
                foreach($id_gambar as $id){
                    $record = array("id_gambar"=>$id, 'id_loker'=>$id_loker);
                    DB::table('gambar')->where('id_gambar', $id)->update(['session'=>$uuid]);
                    DB::table('gambar_loker')->insert($record);
                }
            }
            return redirect('backend/loker')->with('success', 'Berita Berhasil Disimpan');
        }else{

        }
     }

     function delete_loker(Request $r){
        if(!$this->aud()){
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
            return response()->json($respon);
        }
        $respon = array('status'=>true,'message'=>'Berita Berhasil Dihapus!');
        DB::table('loker')->where('uuid',$r->uuid)->delete();          
        return response()->json($respon);
     
     }

     function get_data_loker($uuid){
        $record = DB::table('loker as a')->select('uuid','judul')->where('uuid', $uuid)->first();
        if($record){
            return response()->json($record);
        }else{
            return -1;
        }
     }

}