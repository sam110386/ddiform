<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Frontend.home');
    }


    public function pricing(){
        return view('Frontend.pricing');
    }

    public function help(){
        return view('Frontend.help');
    }
    public function privacy(){
        return view('Frontend.privacy');
    }
    public function terms(){
        return view('Frontend.terms');
    }

    public function dnt_policy(){
        return response()
            ->json(["tracking"=>"N","compliance"=>["https://www.w3.org/2011/tracking-protection/drafts/tracking-compliance.html","http://eur-lex.europa.eu/legal-content/en/ALL/?uri=CELEX:32009L0136"],"policy"=>"https://www.gridble.io/privacy","controller"=>["https://www.gridble.io/privacy"]]);
    }       
}
