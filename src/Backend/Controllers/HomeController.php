<?php

namespace Story\Cms\Backend\Controllers;

// use Story\Cms\Models\Repositories\StatsRepository;

class HomeController extends Controller
{
    /**
     * The StatsRepository implementation
     *
     * @var \Story\Cms\Models\Repository\StatsRepository
     */
    protected $stats;

    // public function __construct(StatsRepository $stats)
    // {
    //     $this->stats = $stats;
    // }

    public function index()
    {
        $stats = [
            (object) ['key' => 'post', 'value' => 1, 'font' => 'book'],
            (object) ['key' => 'page', 'value' => 1, 'font' => 'pages']
        ];

        return view('cms::dashboard', compact('stats'));
    }
}
