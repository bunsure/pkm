<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB; 
use Session;
use Auth;
use Hash;
use Datatables;

class SettingController extends Controller
{
     function indexMenu(){
     	return view("backend.setting.menu");
     }

     

     function data_menu(){
    	$query = DB::table('menu as a')
    	->select('a.id_menu as id_menu','a.nama_menu as nama_menu','a.uuid',
    		'a.url as url', 'a.urutan as urutan',
    		'b.nama_menu as group_menu')
    	->leftjoin('menu as b','b.id_menu','=','a.id_menu_induk')
    	->where('a.id_menu_induk','<>','0');

    	return Datatables::of($query)
    	->addColumn('action', function ($query) {

            $edit = ""; $delete = "";
            if($this->auu()){
                $edit = '<a href="#" class="act" data-toggle="modal" data-uuid="'.$query->uuid.'" data-target="#modal-form-edit-menu" title="Edit"><i class="la la-edit"></i></a> ';
            }
            if($this->aud()){
                $delete = '<a href="#" data-target="#modal-form-hapus-menu" data-uuid="'.$query->uuid.'"  title="Hapus" data-toggle="modal" class="act"><i class="la la-trash"></i></a> ';
            }
            $action =  $edit."".$delete;
            if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

            return $action;
        })
        ->addIndexColumn()
    	->make(true);
    }

    function get_data_menu($uuid){
        $record = DB::table('menu as a')->where('uuid', $uuid)->first();
        if($record){
            $record->informasi = "Nama Menu: ".$record->nama_menu;
            return response()->json($record);
        }else{
            return -1;
        }
    }

    function update_menu(Request $r){
        if(!$this->auu()){
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
            return response()->json($respon);
        }
        $respon = array('status'=>true,'message'=>'Data Menu Berhasil Disimpan!');
        $record = array("nama_menu"=>$r->nama_menu, 
            "id_menu_induk"=>$r->id_menu_induk,
            "url"=>$r->url, 
            "urutan"=>$r->urutan);

        DB::table('menu')->where('uuid',$r->uuid)->update($record);      
        return response()->json($respon);
        
    }

    function insert_menu (Request $r){
        if(!$this->auc()){
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
            return response()->json($respon);
        }
        $respon = array('status'=>false,'message'=>'Data Tidak Valid!');
        $uuid = $this->GenUuid();
        $record = array(
            "nama_menu"=>$r->nama_menu, 
            "id_menu_induk"=>$r->id_menu_induk,
            "url"=>$r->url, 
            "urutan"=>$r->urutan, 
            "uuid"=>$uuid);

        if (DB::table('menu')->insert($record)){
            $respon = array('status'=>true,'message'=>'Berhasil Menambahkan Menu Baru!');
        }        
        return response()->json($respon);
    }

    function delete_menu(Request $r){
        if(!$this->aud()){
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
            return response()->json($respon);
        }
        $respon = array('status'=>true,'message'=>'Data Menu Berhasil Dihapus!');
        $menu = DB::table('menu')->where('uuid',$r->uuid)->first();
        DB::table('menu')->where('uuid',$r->uuid)->delete();     
        DB::table('role_menu')->where('id_menu',$menu->id_menu)->delete();     
        return response()->json($respon);
    }

    //ROLE
    //DT ROLE

    function indexRole(){
        return view("backend.setting.role");
     }

    function data_role(){
        $query = DB::table('roles as a')->
        select('a.id_role as id_role','a.nama_role as nama_role','a.uuid', DB::raw("count(b.id_menu) as n_menu"))
        ->leftjoin('role_menu as b','a.id_role','=','b.id_role')
        ->groupby('a.id_role','a.nama_role','a.uuid');

        return Datatables::of($query)
        ->editColumn('nama_role', function($query){
            $btn =  "<a href=\"".url('backend/setting-role/menu/'.$query->uuid)."\">$query->nama_role</a>";
            return $btn;
        })
        ->addColumn('menu', function($query){
            $btn =  " $query->n_menu Menu ";
            return $btn;
        })
        ->addColumn('action', function ($query) {

            $edit = ""; $delete = "";
            if($this->auu()){
                $edit = '<a href="#" class="act" data-toggle="modal" data-uuid="'.$query->uuid.'" data-target="#modal-form-edit-role" title="Edit"><i class="la la-edit"></i></a> ';
            }
            if($this->aud()){
                $delete = '<a href="#" data-target="#modal-form-hapus-role" data-uuid="'.$query->uuid.'"  title="Hapus" data-toggle="modal" class="act"><i class="la la-trash"></i></a> ';
            }
            $action =  $edit."".$delete;
            if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

            return $action;
        })
        ->addIndexColumn()
        ->rawColumns(['nama_role', 'action'])
        ->make(true);
    }

    function get_data_role($uuid){
        $record = DB::table('roles as a')->where('uuid', $uuid)->first();
        if($record){
            $record->informasi = "Nama Role: ".$record->nama_role;
            return response()->json($record);
        }else{
            return -1;
        }
    }

     function insert_role(Request $r){
        if(!$this->auc()){
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
            return response()->json($respon);
        }
        $respon = array('status'=>true,'message'=>'Data Role Berhasil Disimpan!');
        $record = array("nama_role"=>$r->nama_role, 'uuid'=>$this->GenUuid());
        DB::table('roles')->insert($record);      
        return response()->json($respon);
    }

    function update_role(Request $r){
        if(!$this->auu()){
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
            return response()->json($respon);
        }
        $respon = array('status'=>true,'message'=>'Data Role Berhasil Disimpan!');
        $record = array("nama_role"=>$r->nama_role);

        DB::table('roles')->where('uuid',$r->uuid)->update($record);      
        return response()->json($respon);
    }

    function delete_role(Request $r){

        if(!$this->aud()){
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
            return response()->json($respon);
        }

        $respon = array('status'=>true,'message'=>'Data Role Berhasil Dihapus!');
        $record = DB::table('roles')->where('uuid', $r->uuid)->first();
        if($record){
            DB::table('roles')->where('uuid',$r->uuid)->delete(); 
            //hapus tabel anak
            DB::table('role_menu')->where('id_role', $record->id_role)->delete();
        }
        return response()->json($respon);
    }

    function index_role_menu($uuid){
        $role = DB::table('roles')->where('uuid',$uuid)->first();
        if(!$role){
            return redirect('404');
        }

        $list_menu =DB::table('menu as a')
            ->select('a.id_menu as value',DB::raw("concat(b.nama_menu,' : ' , a.nama_menu) as text"))
            ->leftjoin('menu as b','a.id_menu_induk','=','b.id_menu')
            ->where('a.id_menu_induk','>','0')
            ->orderby('a.id_menu_induk','asc')
            ->orderby('a.urutan','asc')
            ->get();

        return view('backend.setting.role-menu',['role'=>$role,'list_menu'=>$list_menu]);
    }

    function data_role_menu($uuid_role){
        $role = DB::table('roles')->where('uuid', $uuid_role)->first();
        if(!$role){
            return array();
        }

        $query = DB::table('role_menu as a')->select('a.uuid as uuid','c.nama_menu as group_menu','b.nama_menu as nama_menu','a.a_create', 'a.a_update','a.a_delete')
        ->leftjoin('menu as b','a.id_menu','=','b.id_menu')
        ->leftjoin('menu as c','b.id_menu_induk','=','c.id_menu')
        ->where('a.id_role', $role->id_role);

        return Datatables::of($query)
        ->addColumn('action', function ($query) {
            $edit = ""; $delete = "";
            if($this->auu()){
                $edit = '<a href="#" class="act" data-toggle="modal" data-uuid="'.$query->uuid.'" data-target="#modal-form-edit-rolemenu" title="Edit"><i class="la la-edit"></i></a> ';
            }
            if($this->aud()){
                $delete = '<a href="#" data-target="#modal-form-hapus-rolemenu" data-uuid="'.$query->uuid.'"  title="Hapus" data-toggle="modal" class="act"><i class="la la-trash"></i></a> ';
            }
            $action =  $edit."".$delete;
            if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

            return $action;
        })
        ->editColumn('a_create', function($query){
            return  $query->a_create=="1" ? "<i class='fa fa-check'></i>" : "<i class='la la-minus'></i>";
        })
        ->editColumn('a_update', function($query){
           return $query->a_update=="1" ? "<i class='fa fa-check'></i>" : "<i class='la la-minus'></i>";
        })
        ->editColumn('a_delete', function($query){
            return $query->a_delete=="1" ? "<i class='fa fa-check'></i>" : "<i class='la la-minus'></i>";
        })
        ->addIndexColumn()
        ->rawColumns(['menu', 'action','a_create','a_update','a_delete'])
        ->make(true);
    }

    function getRecordRoleMenu($uuid_role, $uuid_role_menu){

        $record = DB::table('role_menu as a')
                ->select('a.*', 'b.nama_menu')
                ->leftjoin('menu as b', 'a.id_menu', '=','b.id_menu')
                ->where('a.uuid', $uuid_role_menu)->first();

        if($record){
            return response()->json($record);
        }else{
            return -1;
        }
    }

    function insert_role_menu(Request $r, $uuid){

        if(!$this->auc()){
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
        }

        $respon = array('status'=>false,'message'=>'Terjadi Kesalahan Data Tidak Valid!');
        $uuid = $this->GenUuid();
        $id_role = decrypt($r->id_role);
        $record = array(
            "id_role"=>$id_role,  
            "id_menu"=>$r->id_menu,  
            "a_create"=>$r->a_create,  
            "a_update"=>$r->a_update,  
            "a_delete"=>$r->a_delete, 
            "uuid"=>$uuid);

        //cek existing
        $exist = DB::table('role_menu')->where('id_role', $id_role)->where('id_menu', $r->id_menu)->count();
        if(!$exist){
            if (DB::table('role_menu')->insert($record)){
                $respon = array('status'=>true,'message'=>'Berhasil Menambahkan Role Menu Baru!');
            }  
        }else{
            $respon = array('status'=>false,'message'=>'Role Menu Sudah Ditambahkan Sebelumnya!');
        }
              
        return response()->json($respon);
    }
    

    function update_role_menu(Request $r, $uuid){

        if(!$this->auu()){
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
        }

        $respon = array('status'=>false,'message'=>'Terjadi Kesalahan Data Tidak Valid!');

        //cek existing
        $exist = DB::table('role_menu')->where('uuid', $r->uuid)->where('id_menu', $r->id_menu)->count();
        if($exist){
           $record = array(
                "a_create"=>$r->a_create,  
                "a_update"=>$r->a_update,  
                "a_delete"=>$r->a_delete, 
                );
           DB::table('role_menu')->where('uuid',$r->uuid)->update($record);
           $respon = array('status'=>true,'message'=>'Perubahan Data Berhasil Disimpan!');
        }else{
            $respon = array('status'=>false,'message'=>'Role Menu Tidak Ditemukan!');
        }
              
        return response()->json($respon);
    }

    function delete_role_menu(Request $r, $uuid){
        
        if(!$this->aud()){
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
        }

        $respon = array('status'=>true,'message'=>'Role Menu Berhasil Dihapus!');
        DB::table('role_menu')->where('uuid',$r->uuid)->delete();     
        return response()->json($respon);
    }


    //SETING ROLE
    function indexUser(){
        return view('backend.setting.user');
    }

    function data_user(){

        $query = DB::table('users as a')
        ->select('a.id as id_user','a.username as username','a.uuid',
            'a.nama_pengguna as nama_pengguna', 'a.email as email',
            'a.telp as telp',DB::raw("count(b.id_user_role) as role") )
        ->leftjoin('user_role as b', 'b.id_user','=','a.id')
        ->groupby('a.id')
        ->groupby('a.username')
        ->groupby('a.nama_pengguna')
        ->groupby('a.uuid')
        ->groupby('a.email')
        ->groupby('a.telp');

        return Datatables::of($query)
        ->addColumn('action', function ($query) {

            $edit = ""; $delete = "";
            if($this->auu()){
                $edit = '<a href="#" class="act" data-toggle="modal" data-uuid="'.$query->uuid.'" data-target="#modal-form-edit-user" title="Edit"><i class="la la-edit"></i></a> ';
            }
            if($this->auu()){
                $edit .= '<a href="#" class="act" data-toggle="modal" data-uuid="'.$query->uuid.'" data-target="#modal-form-edit-password" title="Ubah Password"><i class="la la-key"></i></a> ';
            }
            if($this->aud()){
                $delete = '<a href="#" data-target="#modal-form-hapus-user" data-uuid="'.$query->uuid.'"  title="Hapus" data-toggle="modal" class="act"><i class="la la-trash"></i></a> ';
            }
            $action =  $edit."".$delete;
            if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

            return $action;
        })
        ->editColumn('role', function($query){
            return "<a href=\"".url('backend/setting-user/role/uuid/'.$query->uuid)."\">$query->role Role</a>";
        })
        ->addIndexColumn()
        ->rawColumns(['action','role'])
        ->make(true);

    }
    
    function getRecordUser($uuid){
        $record = DB::table('users as a')
                        ->select('a.uuid','a.username','a.nama_pengguna','a.id','a.email','a.telp')
                        ->where('uuid', $uuid)->first();
        if($record){
            return response()->json($record);
        }else{
            return -1;
        }
    }

    function insert_user(Request $r){
        $respon = array('status'=>false,'message'=>'Data Tidak Valid!');
        if($r->password1!=$r->password2){
            return response()->json($respon);
        }
        $password = Hash::make($r->password1);
        $uuid = $this->GenUuid();
        $record = array(
            "username"=>$r->username, 
            "nama_pengguna"=>$r->nama_pengguna,
            "email"=>$r->email,
            "telp"=>$r->telp,
            "password"=>$password,
            "created_at"=>date('Y-m-d H:i:s'),
            "uuid"=>$uuid);

        if(DB::table('users')->where('username', $r->username)->count()){
             return response()->json( array('status'=>false,'message'=>'Username Sudah Digunakan!'));
        }      

        if (DB::table('users')->insert($record)){
            $respon = array('status'=>true,'message'=>'Berhasil Menambahkan User Baru!');
        }  
        return response()->json($respon);
    }

    function update_user(Request $r){
        
        $respon = array('status'=>true,'message'=>'Data User Berhasil Disimpan!');
        $record = array(
                    "nama_pengguna"=>$r->nama_pengguna,
                    "email"=>$r->email,
                    "telp"=>$r->telp,
                );


        DB::table('users')->where('uuid',$r->uuid)->update($record);      
        return response()->json($respon);
    }

    function update_password (Request $r){
        $username = $r->username;
        $pass1 = $r->password1;
        $pass2 = $r->password2;
        $password_baru = Hash::make($pass1);

        $record = array('password'=>$password_baru);
        DB::table('users')->where('username', $username)->update($record);
       
        $respon = array('status'=>true,'message'=>'Password User Berhasil Diubah!');        
        return response()->json($respon);
    }

    function delete_user(Request $r){
        
        $respon = array('status'=>true,'message'=>'Data Berhasil Dihapus!');
        $user = DB::table('users')->where('uuid',$r->uuid)->first();

        DB::table('users')->where('uuid',$r->uuid)->delete();     
        DB::table('user_role')->where('id_user',$user->id)->delete();     
       // DB::table('user_role_instansi')->where('id_user',$user->id)->delete();     
        return response()->json($respon);
    }


    function index_user_role($uuid){
        $user = DB::table('users')->where('uuid', $uuid)->first();
        $role = DB::table('roles')->select('id_role as value','nama_role as text')->get();
        return view('backend.setting.user-role',['list_role'=>$role,'user'=>$user]);
    }

    function data_user_role($uuid){
        $user  = DB::table('users')->where('uuid', $uuid)->first();
        $id_user = $user->id;

        $query = DB::table('user_role as a')
        ->select('a.uuid','b.nama_role')
        ->join('roles as b', 'b.id_role','=','a.id_role')
        ->where('a.id_user','=',$id_user)
        ->groupby('a.id_role')
        ->groupby('a.uuid')
        ->groupby('b.nama_role');

        return Datatables::of($query)
                  ->addColumn('action', function ($query) {
                        $edit = ""; $delete = "";
                        if($this->aud()){
                            $delete = '<a href="#" data-target="#modal-form-hapus-user-role" data-uuid="'.$query->uuid.'"  title="Hapus" data-toggle="modal" class="act"><i class="la la-trash"></i></a> ';
                        }
                        $action =  $edit."".$delete;
                        if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }

                        return $action;
                    })
                 ->addIndexColumn()
                 ->rawColumns(['action','instansi'])
                 ->make(true);

    }

    function getRecordUserRole($uuid){
        $record = DB::table('user_role as a')
            ->select('b.nama_role','a.uuid')
            ->join('roles as b','a.id_role','b.id_role')
            ->where('a.uuid', $uuid)
            ->first();
        return response()->json($record);
    }

    function insert_user_role(Request $r){
        $uuid = $this->GenUuid();
        $respon = array('status'=>true,'message'=>'Data Role Berhasil Disimpan!');
        $id_user = decrypt($r->id_user);
        $id_role = $r->id_role;

        //cek existing
        if(DB::table('user_role')->where('id_user', $id_user)->where('id_role',$id_role)->count()==0){
            DB::table('user_role')->insert(['id_role'=>$id_role, 'id_user'=>$id_user, "uuid"=>$uuid]);
        }else{
            $respon = array('status'=>false,'message'=>'Role User Sudah Ada!');
        }

        return response()->json($respon);
    }

    function delete_user_role(Request $r){

        $respon = array('status'=>true,'message'=>'Data Berhasil Dihapus!');
        $user_role = DB::table('user_role')->where('uuid',$r->uuid)->first();

        DB::table('user_role')->where('uuid',$r->uuid)->delete();       

        return response()->json($respon);
    }
}