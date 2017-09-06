<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Story\Cms\Config\ConfigManager;
use Story\Cms\Backend\Controllers\Controller;
use Illuminate\Http\Request;

class MediaController extends Controller
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
        $thumbnail = $this->config->get('SITE_MEDIA_THUMBNAIL');
        $medium = $this->config->get('SITE_MEDIA_MEDIUM');
        $large = $this->config->get('SITE_MEDIA_LARGE');

        $config = [
            'thumbnail' => $thumbnail ? (array) $thumbnail : config()->get('cms.images.thumbnail'),
            'medium' => $medium ? (array) $medium : config()->get('cms.images.medium'),
            'large' => $large ? (array) $large : config()->get('cms.images.large'),
        ];

        return $this->view('cms::settings.media', compact('config'));
    }

    /**
     * Update media information for site
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->config->set('SITE_MEDIA_THUMBNAIL', json_encode($request->input('site_media_thumbnail')));
        $this->config->set('SITE_MEDIA_MEDIUM', json_encode($request->input('site_media_medium')));
        $this->config->set('SITE_MEDIA_LARGE', json_encode($request->input('site_media_large')));

        return response()->json([
            'meta' => [
                'message' => 'Setting is updated.'
            ]
        ]);
    }
}
