<?php

namespace Story\Cms\Frontend\Controllers;

class HomeController extends Controller
{
    /**
     * Display website homepage
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->view('index');
    }
}
