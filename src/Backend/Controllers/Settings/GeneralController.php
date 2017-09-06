<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Story\Cms\Config\ConfigManager;
use Story\Cms\Backend\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
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
        $config = $this->config->all();

        return $this->view('cms::settings.general', compact('config'));
    }

    /**
     * Update general information for site
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->config->set('SITE_TITLE', $request->input('site_title'));
        $this->config->set('SITE_TAGLINE', $request->input('site_tagline'));
        $this->config->set('SITE_MEMBERSHIP', $request->input('site_membership'));
        $this->config->set('SITE_DATE_FORMAT', $request->input('date_format'));
        $this->config->set('SITE_TIME_FORMAT', $request->input('time_format'));

        return response()->json([
            'meta' => [
                'message' => 'Setting is updated.'
            ]
        ]);
    }
}
