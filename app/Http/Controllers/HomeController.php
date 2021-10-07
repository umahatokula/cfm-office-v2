<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //if user is logged in
        if (\Auth::check()) {

            return redirect('/dashboard');

        }


        return redirect('login');
        // return view('home');
    }
}
