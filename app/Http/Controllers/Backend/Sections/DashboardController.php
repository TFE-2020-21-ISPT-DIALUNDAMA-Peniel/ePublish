<?php

namespace App\Http\Controllers\BackEnd\Sections;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
        
    }

    public function index()
    {
      return view('backend.sections.index',['user'=>Auth::user()]);    
           
    }
}
