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


class PageController extends Controller
{
      function home(){
        
         return view('home');
      }

      function baca_berita($uuid){
        $berita = DB::table('berita')->where('uuid', $uuid)->first();
        if(!$berita){
            return view('404');
        }
        $titlepage = "Berita: ". $berita->judul;
        return view('berita.baca',compact('berita','titlepage'));
      }

      function list_berita(){
        $berita = DB::table('berita')->orderby('id_berita','desc')->paginate(6);
        $titlepage = "Berita";
        return view('berita.list',compact('berita','titlepage'));
      }

      function baca_halaman($uuid){
        $halaman = DB::table('halaman')->where('uuid', $uuid)->first();
        if(!$halaman){
            return view('404');
        }
        $titlepage = $halaman->judul;
        return view('halaman.baca',compact('halaman','titlepage'));
      }

      function baca_pembelajaran($uuid){
        $pembelajaran = DB::table('pembelajaran')->where('uuid', $uuid)->first();
        if(!$pembelajaran){
            return view('404');
        }
        $titlepage = "Pembelajaran: ". $pembelajaran->judul;
        return view('pembelajaran.baca',compact('pembelajaran','titlepage'));
      }

      function list_pembelajaran(){
        $pembelajaran = DB::table('pembelajaran')->orderby('id_pembelajaran','desc')->paginate(6);
        $titlepage = "Pembelajaran";
        return view('pembelajaran.list',compact('pembelajaran','titlepage'));
      }

      function baca_budayabaca($uuid){
        $budayabaca = DB::table('budayabaca')->where('uuid', $uuid)->first();
        if(!$budayabaca){
            return view('404');
        }
        $titlepage = "Budaya Baca". $budayabaca->judul;
        return view('budayabaca.baca',compact('budayabaca','titlepage'));
      }

      function list_budayabaca(){
        $budayabaca = DB::table('budayabaca')->orderby('id_budayabaca','desc')->paginate(6);
        $titlepage = "Budaya Baca";
        return view('budayabaca.list',compact('budayabaca','titlepage'));
      }

      function baca_manajemen($uuid){
        $manajemen = DB::table('manajemen')->where('uuid', $uuid)->first();
        if(!$manajemen){
            return view('404');
        }
        $titlepage = "Manajemen Sekolah". $manajemen->judul;
        return view('manajemen.baca',compact('manajemen','titlepage'));
      }

      function list_manajemen(){
        $manajemen = DB::table('manajemen')->orderby('id_manajemen','desc')->paginate(6);
        $titlepage = "Manajemen Sekolah";
        return view('manajemen.list',compact('manajemen','titlepage'));
      }


      function baca_parenting($uuid){
        $parenting = DB::table('parenting')->where('uuid', $uuid)->first();
        if(!$parenting){
            return view('404');
        }
        $titlepage = "Parenting". $parenting->judul;
        return view('parenting.baca',compact('parenting','titlepage'));
      }

      function list_parenting(){
        $parenting = DB::table('parenting')->orderby('id_parenting','desc')->paginate(6);
        $titlepage = "Parenting";
        return view('parenting.list',compact('parenting','titlepage'));
      }

      function baca_literasi($uuid){
        $literasi = DB::table('literasi')->where('uuid', $uuid)->first();
        if(!$literasi){
            return view('404');
        }
        $titlepage = "Literasi". $literasi->judul;
        return view('literasi.baca',compact('literasi','titlepage'));
      }

      function list_literasi(){
        $literasi = DB::table('literasi')->orderby('id_literasi','desc')->paginate(6);
        $titlepage = "Literasi";
        return view('literasi.list',compact('literasi','titlepage'));
      }


      function baca_inspiratif($uuid){
        $inspiratif = DB::table('inspiratif')->where('uuid', $uuid)->first();
        if(!$inspiratif){
            return view('404');
        }
        $titlepage = "Sosok Inspiratif". $inspiratif->judul;
        return view('inspiratif.baca',compact('inspiratif','titlepage'));
      }

      function list_inspiratif(){
        $inspiratif = DB::table('inspiratif')->orderby('id_inspiratif','desc')->paginate(6);
        $titlepage = "Sosok Inspiratif";
        return view('inspiratif.list',compact('inspiratif','titlepage'));
      }

      function dokumen(){
        $dokumen = DB::table('dokumen')->orderby('id_dokumen','desc')->paginate(10);
        $titlepage = "Dokumen Pembelajaran (dokumen) ";
        return view('dokumen.list',compact('dokumen','titlepage'));
      }

      function visi(){
        $titlepage = "Visi dan Misi";
        return view('halaman.visi',compact('visi','titlepage')); 
      }

      function tata(){
        $titlepage = "Tata Nilai  Puskesmas Muara Bulian";
        return view('halaman.tata-nilai',compact('tata-nilai','titlepage'));
      }
      function hak(){
        $titlepage = "Hak dan Kewajiban Pasien  Puskesmas Muara Bulian";
        return view('halaman.hak',compact('hak-kewajiban','titlepage'));
      }

      function gallery(){
        $gallery = DB::table('gallery_photo')->orderby('id_gallery','desc')->paginate(10);
        $titlepage = "Gallery Photo ";
        return view('gallery.list',compact('gallery','titlepage'));
      }

      function download(){
        $download = DB::table('download')->orderby('id_dokumen','desc')->paginate(10);
        $titlepage = "Dokumen (download) ";
        return view('download.list',compact('download','titlepage'));
      }

      function baca_loker($uuid){
        $loker = DB::table('loker')->where('uuid', $uuid)->first();
        if(!$loker){
          return view('404');
        }
        $titlepage = "Lowongan Kerja". $loker->judul;
        return view('loker.baca',compact('loker','titlepage'));
      }

      function list_loker(){
        $loker = DB::table('loker')->orderby('id_loker','desc')->paginate(6);
        $titlepage = "Lowongan Kerja ";
        return view('loker.list',compact('loker','titlepage'));
      }
}