<?php

namespace Story\Framework\Frontend\Controllers;

use SEO;
use Configuration;

class HomeController extends Controller
{
    /**
     * Display website homepage
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::instance([
            'title' => Configuration::instance()->SITE_TITLE,
            'description' => Configuration::instance()->SITE_TAGLINE
        ]);

        return $this->view('index');
    }
}
