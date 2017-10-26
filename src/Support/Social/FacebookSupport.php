<?php

namespace Story\Cms\Support\Social;

use Configuration;
use Facebook\Facebook;
use Laravel\Socialite\Facades\Socialite as Socialite;
use Story\Cms\Contracts\StorySocial;

class FacebookSupport implements StorySocial
{
    protected $fb;
    protected $access_token;

    public function __construct()
    {
        $this->fb = new Facebook([
          'app_id' => config('services.facebook.client_id'),
          'app_secret' => config('services.facebook.client_secret'),
          'default_graph_version' => 'v2.10'
        ]);

        $this->access_token = (string) Configuration::instance()->FB_ACCESS_TOKEN;
    }

    public function post($tags = array(), $title, $excerpt = '', $url, $path = '')
    {
        if ($this->validate()) {
            if ($this->access_token != '') {
                $this->fb->setDefaultAccessToken($this->access_token);

                // post on behalf of page
                $pages = $this->fb->get('/me/accounts');
                $pages = $pages->getGraphEdge()->asArray();
                foreach ($pages as $key) {
                     $post = $this->fb->post('/' . $key['id'] . '/feed', array(
                        'message' => $title,
                        'link' => $url
                    ), $key['access_token']);
                    $post = $post->getGraphNode()->asArray();
                }
            }
        }
    }

    public function validate()
    {
        return Configuration::instance()->FB_APP_ID != '' && Configuration::instance()->FB_APP_SECRET != '' && Configuration::instance()->FB_ACCESS_TOKEN != '';
    }
}
