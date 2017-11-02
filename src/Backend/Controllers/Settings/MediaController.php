<?php

namespace Story\Framework\Backend\Controllers\Settings;

use Configuration;
use Story\Framework\Backend\Controllers\Controller;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display general form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = Configuration::instance();

        $config = [
            'thumbnail' => $config->SITE_MEDIA_THUMBNAIL ? : config()->get('cms.images.thumbnail'),
            'medium' => $config->SITE_MEDIA_MEDIUM ? : config()->get('cms.images.medium'),
            'large' => $config->SITE_MEDIA_LARGE ? : config()->get('cms.images.large'),
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
        Configuration::set('SITE_MEDIA_THUMBNAIL', json_encode($request->input('site_media_thumbnail')));
        Configuration::set('SITE_MEDIA_MEDIUM', json_encode($request->input('site_media_medium')));
        Configuration::set('SITE_MEDIA_LARGE', json_encode($request->input('site_media_large')));

        return response()->json([
            'meta' => [
                'message' => 'Setting is updated.'
            ]
        ]);
    }
}
