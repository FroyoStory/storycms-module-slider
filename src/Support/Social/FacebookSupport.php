<?php

namespace Story\Cms\Support\Social;

use Configuration;
use Laravel\Socialite\Facades\Socialite as Socialite;
use Facebook\Facebook;

class FacebookSupport {

    private $fb;
    protected $login;

    public function __construct()
    {
        $this->fb = new Facebook([
          'app_id' => config('services.facebook.client_id'),
          'app_secret' => config('services.facebook.client_secret'),
          'default_graph_version' => 'v2.10'
        ]);
    }

    public function post($access_token, $title, $url)
    {
        $check = 'http://google.com';
        if (Configuration::instance()->FB_ACCESS_TOKEN != '') {
            $this->fb->setDefaultAccessToken($access_token);

            // post on behalf of page
            $pages = $this->fb->get('/me/accounts');
            $pages = $pages->getGraphEdge()->asArray();
            foreach ($pages as $key) {
                 $post = $this->fb->post('/' . $key['id'] . '/feed', array(
                    'message' => $title,
                    'link' => $check
                ), $key['access_token']);
                $post = $post->getGraphNode()->asArray();
            }
        }
    }
}
