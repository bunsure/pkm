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

class HalamanMenuController extends Controller
{
     function index(){
     	return view("backend.tree.index");
     }

     function get_node(Request $r){

        $id_node = $r->id;
        if($id_node==="#"){


            $arr = [
                ["id"=>'root',"text"=>'Root Menu',
                    "children"=>true, "type"=>'root', "icon"=>'fa fa-folder']
                ];
        }

        if ($id_node!="#"){
            $node = DB::table('tree_menu')->where('id_induk',$id_node)->get();
            $arr = array();
            foreach ($node as $n){
                $informasi = "";
                $action = '<span class="action-trees">
                            <a href="#" data-toggle="modal" data-id="'.$n->id_node.'" data-target="#modal-form-edit-node"><i class="la la-edit"></i></a>
                            <a href="#" data-toggle="modal" data-id="'.$n->id_node.'"data-target="#modal-form-hapus-node"><i class="la la-trash"></i></a>
                            </span>';
                $icon = "";
                if ($n->tipe=='direktori'){
                    $icon = "fa fa-folder";
                }
                if ($n->tipe=='page'){
                    $icon = "fa fa-file";
                }
                if ($n->tipe=='url'){
                    $icon = "fa fa-link";
                }
                $tmp = array(
                    "id"=>$n->id_node,
                    "text"=>$n->judul.$action.$informasi,
                    "children"=>$n->tipe==='direktori',
                    "type"=>'node',
                    "icon"=>$icon
                );
                array_push($arr, $tmp);
            }
        }        
        return response()->json($arr);
     }

     function get_data_node($id){
        $record = DB::table('tree_menu as a')->where('id_node', $id)->first();
        if($record){
            return response()->json($record);
        }else{
            return -1;
        }
     }

     function insert_node(Request $r){
        $judul= $r->judul;
        $id_induk= $r->id_induk;
        $tipe= $r->tipe;
        $id_halaman = null;
        $url = null;
        $uuid = $this->GenUuid();

        //cek induk as direktori
        $induk_direktori = DB::table('tree_menu')->where('id_node', $id_induk)->where('tipe','direktori')->first();
        if (!$induk_direktori &&  $id_induk!='root'){
            $respon = array('status'=>false,'message'=>'Gagal Menambahkan Karena Node Induk Bukan Direktori!');
            return response()->json($respon);
        }
        if($tipe=='page'){
            $id_halaman = $r->id_halaman;
        }
        if($tipe=='url'){
            $url = $r->url;
        }
        $record = array(
                "id_node"=>$this->randomID(),
                "id_induk"=>$id_induk,
                "judul"=>$judul,
                "tipe"=>$tipe,
                "url"=>$url,
                "id_halaman"=>$id_halaman
                 );
        DB::table('tree_menu')->insert($record);
        $respon = array('status'=>true,'message'=>'Data Berhasil Disimpan!');
        return response()->json($respon);
     }

     function delete_node(Request $r){
       // $id_node = $r->id_node;
        $respon = array('status'=>true,'message'=>'Data Node Berhasil Dihapus!');
        $record = DB::table('tree_menu')->where('id_node', $r->id_node)->first();
        if($record){
            DB::table('tree_menu')->where('id_node',$r->id_node)->delete(); 
            //hapus tabel anak
            $anak = DB::table('tree_menu')->where('id_induk', $r->id_node)->get();
            foreach ($anak as $a){
                DB::table('tree_menu')->where('id_induk', $a->id_node)->delete();
            }
            DB::table('tree_menu')->where('id_induk', $r->id_node)->delete();
        }
        return response()->json($respon);
     }

     function update_node(Request $r){
        $judul= $r->judul;
        $tipe= $r->tipe;
        $id_halaman = null;
        $url = null;
        if($tipe=='page'){
            $id_halaman = $r->id_halaman;
        }
        if($tipe=='url'){
            $url = $r->url;
        }
        $record = array(
                "judul"=>$judul,
                "tipe"=>$tipe,
                "url"=>$url,
                "id_halaman"=>$id_halaman
                 );
        DB::table('tree_menu')->where('id_node', $r->id_node)->update($record);
        $respon = array('status'=>true,'message'=>'Data Berhasil Disimpan!');
        return response()->json($respon);
     }


     function form_edit_node($id){
        $record = DB::table('tree_menu')->where('id_node', $id)->first();
        return view('backend.halaman.form-edit-node', compact('record'));
     }


}