<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Story\Cms\Config\ConfigManager;
use Story\Cms\Backend\Controllers\Controller;
use Illuminate\Http\Request;

class PermalinkController extends Controller
{
    /**
     * The ConfigManager implementation.
     *
     * @var Story\Cms\Config\ConfigManager
     */
    protected $config;

    /**
     * Update general setting for site
     *
     * @param Configuration $config
     */
    public function __construct(ConfigManager $config)
    {
        $this->config = $config;
    }

    /**
     * Display general form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return $this->view('cms::settings.permalink');
    }

    /**
     * Update media information for site
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->config->set('SITE_PERMALINK', $request->input('site_permalink'));

        return response()->json([
            'meta' => [
                'message' => 'Setting is updated.'
            ]
        ]);
    }
}
