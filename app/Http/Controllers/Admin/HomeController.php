<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB; 
use Session;
use Auth;
use Hash;

class HomeController extends Controller
{
     function index(){
     	return view("backend.home.sample");
     }
}