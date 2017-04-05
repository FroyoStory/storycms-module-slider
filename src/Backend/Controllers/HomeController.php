<?php

namespace Story\Cms\Backend\Controllers;

use Story\Cms\Models\Repositories\StatsRepository;

class HomeController extends Controller
{
    /**
     * The StatsRepository implementation
     *
     * @var \Story\Cms\Models\Repository\StatsRepository
     */
    protected $stats;

    public function __construct(StatsRepository $stats)
    {
        $this->stats = $stats;
    }

    public function index()
    {
        $this->data['stats'] = [
            (object) ['key' => 'post', 'value' => $this->stats->get('post'), 'font' => 'book'],
            (object) ['key' => 'page', 'value' => $this->stats->get('page'), 'font' => 'pages']
        ];

        return $this->view('dashboard');
    }
}
