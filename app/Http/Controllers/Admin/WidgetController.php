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


class WidgetController extends Controller
{
     function index(){
        $widget = DB::table('widget')->get();
     	return view("backend.widget.index", compact('widget'));
     }

     function edit_widget($id_widget){
        $widget = DB::table('widget')->where('id_widget',$id_widget)->first();
        return view("backend.widget.edit", compact('widget'));
     }

     function update(Request $r){
        $id_widget = $r->id_widget;
        $code = $r->code;
        $record = array("code"=>$code);
        DB::table('widget')->where('id_widget', $id_widget)->update($record);
        return redirect('backend/widget/edit/'.$id_widget)->with('success', 'Widget Berhasil Diperbaharui!');
     }
}