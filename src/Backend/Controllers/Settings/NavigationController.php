<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Illuminate\Http\Request;
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

    public function create()
    {

    }

    public function store()
    {

    }

    /**
     * Show the form data to update the model
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = $this->navigation->getById($id);

        return $this->view('settings.navigation.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        if ($this->navigation->update($request, $id)) {
            session()->flash('info', 'Setting successfully saved.');
        } else {
            session()->flash('error', 'Unable to save settings');
        }

        return redirect()->back();
    }

    public function destroy()
    {

    }
}
