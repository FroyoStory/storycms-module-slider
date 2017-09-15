<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Configuration;
use Story\Cms\Support\Theme;
use Story\Cms\Backend\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * The theme class implementation.
     *
     * @var Story\Cms\Support\Theme
     */
    protected $themes;

    /**
     * Create themes controller
     *
     * @param Theme $themes
     */
    public function __construct(Theme $themes)
    {
        $this->themes = $themes;
    }

    /**
     * Display all available themes in
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = $this->themes->all();
        $theme = $this->themes->current();

        return $this->view('cms::settings.themes.index', compact('themes', 'theme'));
    }

    /**
     * Save current theme into website config
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'key' => 'required'
        ]);

        // @TODO create validation
        $this->themes->set($request->input('key'));

        return response()->json([
            'data' => '',
            'meta' => [
                'message' => 'Theme has been changed.'
            ]
        ]);
    }
}
