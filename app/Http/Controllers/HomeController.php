<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasta;

class HomeController extends Controller
{
	private $_pasta;
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->_pasta = new Pasta();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
    			'pasta_pages' => $this->_pasta->getUserTextsPage(5),
    			]);
    }
    
}
