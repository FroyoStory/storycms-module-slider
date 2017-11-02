<?php

namespace Story\Framework\Backend\Controllers;

// use Story\Framework\Models\Repositories\StatsRepository;

class HomeController extends Controller
{
    /**
     * The StatsRepository implementation
     *
     * @var \Story\Framework\Models\Repository\StatsRepository
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
