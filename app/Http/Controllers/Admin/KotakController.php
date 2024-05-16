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


class KotakController extends Controller
{
     function index_pesan(){
     	return view("backend.kontak.index-pesan");
     }


     function dt_pesan(){
        loadHelper('format');
        $query = DB::table('pesan as a')
        ->select('a.id_pesan as id_pesan','a.dibaca','a.nama_lengkap','a.created_at','a.email','a.phone','a.subjek')
        ->orderby('id_pesan','desc');

        return Datatables::of($query)
        ->editColumn('nama_lengkap', function ($query) {
            $nama= $query->nama_lengkap;
            $detail='<a href="'.url('backend/kotak-pesan/view/'.$query->id_pesan).'">'.$nama.'</a>';
            return $detail;
        })
        ->editColumn('email', function ($query) {
            $nama= $query->email;
            return $nama;
        })
         ->editColumn('created_at', function ($query) {
             
            return tgl_indo_singkat(substr($query->created_at, 0,10));
        })
        ->addColumn('rowClass', function($query){
            if($query->dibaca==1){
                return '';
            }else{
                return 'unread';
            }
        })
        ->addIndexColumn()
        ->rawColumns(['action','nama_lengkap'])
        ->make(true);
     }

     function view_pesan($id_pesan){
        DB::table('pesan')->where('id_pesan', $id_pesan)->update(['dibaca'=>1]);
        $pesan = DB::table('pesan')->where('id_pesan', $id_pesan)->first();
        return view("backend.kontak.view-pesan", compact('pesan'));
     }

     function index_pengaduan(){
        return view("backend.kontak.index-pengaduan");
     }


     function dt_pengaduan(){
        loadHelper('format');
        $query = DB::table('pengaduan as a')
        ->select('a.id_pengaduan as id_pengaduan','a.nomor_pengaduan',
            'a.dibaca','a.nama_lengkap','a.created_at','a.email','a.phone','a.subjek')
        ->orderby('id_pengaduan','desc');

        return Datatables::of($query)
        ->editColumn('nomor_pengaduan', function ($query) {
            $nama= $query->nama_lengkap;
            $detail='<a href="'.url('backend/kotak-pengaduan/view/'.$query->id_pengaduan).'">'.$query->nomor_pengaduan.'</a>';
            return $detail;
        })
        ->editColumn('nama_lengkap', function ($query) {
            $nama= $query->nama_lengkap;
            return $nama;
        })
        ->editColumn('email', function ($query) {
            $nama= $query->email;
            return $nama;
        })
         ->editColumn('created_at', function ($query) {
            return tgl_indo_singkat(substr($query->created_at, 0,10));
        })
        ->addColumn('rowClass', function($query){
            if($query->dibaca==1){
                return '';
            }else{
                return 'unread';
            }
        })
        ->addIndexColumn()
        ->rawColumns(['action','nomor_pengaduan'])
        ->make(true);
     }

     function view_pengaduan($id_pengaduan){
        DB::table('pengaduan')->where('id_pengaduan', $id_pengaduan)->update(['dibaca'=>1]);
        $pengaduan = DB::table('pengaduan')->where('id_pengaduan', $id_pengaduan)->first();
         $dokumen = DB::table('dokumen_pengaduan')->where('id_pengaduan', $id_pengaduan)->get();
        return view("backend.kontak.view-pengaduan", compact('pengaduan','dokumen'));
     }

    
}