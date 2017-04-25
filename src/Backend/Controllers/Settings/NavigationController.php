<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Story\Cms\Backend\Controllers\Controller;
use Story\Cms\Models\Repositories\NavigationRepository;

class NavigationController extends Controller
{
    /**
     * The NavigationRepository implementation repository
     *
     * @var \Story\Cms\Models\Repositories\NavigationRepository
     */
    protected $navigation;

    /**
     * Create navigation controller
     *
     * @param NavigationRepository $navigation
     */
    public function __construct(NavigationRepository $navigation)
    {
        $this->navigation = $navigation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->navigation->findByCode('main')->descendants->toTree();

        return $this->view('settings.navigation.index', compact('menus'));
    }
}
