<?php

namespace Story\Cms\Listeners;

use Story\Cms\Events\PostCreated;
use Configuration;
use Log;
use TwitterAPIExchange;

class PostToSocial
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $request = $event->request;


        if (Configuration::instance()->SWITCH == '1') {
                Configuration::set('CHECKING', 'yes');
                //handle twitter
                if (Configuration::instance()->TW_ACCESS_TOKEN != '' && Configuration::instance()->TW_ACCESS_TOKEN_SECRET != '' && Configuration::instance()->TW_CONSUMER_KEY != '' && Configuration::instance()->TW_CONSUMER_SECRET != '') {
                    $settings = array(
                        'oauth_access_token' => Configuration::instance()->TW_ACCESS_TOKEN,
                        'oauth_access_token_secret' => Configuration::instance()->TW_ACCESS_TOKEN_SECRET,
                        'consumer_key' => Configuration::instance()->TW_CONSUMER_KEY,
                        'consumer_secret' => Configuration::instance()->TW_CONSUMER_SECRET
                    );

                    $url = 'https://api.twitter.com/1.1/statuses/update.json';
                    $requestMethod = 'POST';

                    if ($post->featured_image) {
                        $postfields = array(
                            'status'    => $post->title. ' ' .$post->url,
                            'media_ids' => $post->featured_image
                        );
                    } else {
                        $postfields = array(
                            'status'    => $post->title. ' ' .$post->url
                        );
                    }

                    $twitter = new TwitterAPIExchange($settings);

                    echo $twitter->buildOauth($url, $requestMethod)
                                 ->setPostfields($postfields)
                                 ->performRequest();
                }

                //handle facebook
                if (Configuration::instance()->FB_APP_ID != '' && Configuration::instance()->FB_APP_SECRET != '' && Configuration::instance()->FB_ACCESS_TOKEN != '') {
                    Configuration::set('FB_GET', 'YES');
                }

                //handle instagram
                if (Configuration::instance()->INSTA_USERNAME != '' && Configuration::instance()->INSTA_PASSWORD != '') {

                }
        }
        $post->save();
    }
}
