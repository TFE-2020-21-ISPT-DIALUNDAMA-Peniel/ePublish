<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Requests\StudentAuthFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Code;


class AuthController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['sessionActive']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $content = view('frontend.students.auth')->render();
       return response($content);
    }


    /**
     * Traitement du formulaire
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentAuthFormRequest $request)
    {

       $student = Code::getStudentAndCode($request['code']);
       session(['student' => $student]); 
       if ($request->ajax()) {
           return route('publish.show',getPublishUrl());
       }
       return redirect()->route('publish.show',getPublishUrl());

    }
}