<?php

namespace Story\Cms\Listeners;

use Story\Cms\Events\PostCreated;
use Configuration;
use Log;

class PostToSocial
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $config = Configuration::instance();
    }

    /**
     * Handle the event.
     *
     * @param  PostCreated  $post
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $post = $event->post;
        print_r($config);

        // if ($config->switch == 1) {

        //     if ($config->TW_ACCESS_TOKEN != '' && $config->TW_ACCESS_TOKEN_SECRET != '' && $config->TW_CONSUMER_KEY != '' && $config->TW_CONSUMER_SECRET != '') {
        //         $settings = array(
        //             'oauth_access_token' => $config->TW_ACCESS_TOKEN,
        //             'oauth_access_token_secret' => $config->TW_ACCESS_TOKEN_SECRET,
        //             'consumer_key' => "YOUR_CONSUMER_KEY",
        //             'consumer_secret' => "YOUR_CONSUMER_SECRET"
        //         );
        //     }
        //     $request = $event->request;
        //     $request->input();
        // }
        $post->save();
    }
}
