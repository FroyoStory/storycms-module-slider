<?php

namespace Story\Cms\Support\Social;

use Configuration;
use Facebook\Facebook;

class FacebookSupport {

    private $fb;

    public function __construct()
    {
        $this->fb = new Facebook([
          'app_id' => config('services.facebook.client_id'),
          'app_secret' => config('services.facebook.client_secret'),
          'default_graph_version' => 'v2.10',
          'default_access_token' => (string) Configuration::instance()->FB_ACCESS_TOKEN,
        ]);
    }

    public function post($imagesource, $caption, $url)
    {
        try {
            $response = $this->fb->post('/me/feed', [
                'source' => $imagesource,
                'caption' => $caption,
                'link' => $url
            ]);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }
}
