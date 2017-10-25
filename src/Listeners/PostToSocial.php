<?php

namespace Story\Cms\Listeners;

use Story\Cms\Events\PostCreated;
use Configuration;
use Log;
use Story\Cms\Support\Social\FacebookSupport;
use Story\Cms\Support\Social\TwitterSupport;
use Story\Cms\Support\Social\InstagramSupport;

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
            if($request->input('post_status') == 'publish') {
                if ($post->meta->featured_image) {
                    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                        $path = public_path().str_replace("/", "\\", $post->meta->featured_image);
                    } else {
                        $path = public_path().$post->meta->featured_image;
                    }
                } else {
                    $path = '';
                }

                //handle twitter
                if (Configuration::instance()->TW_ACCESS_TOKEN != '' && Configuration::instance()->TW_ACCESS_TOKEN_SECRET != '' && Configuration::instance()->TW_CONSUMER_KEY != '' && Configuration::instance()->TW_CONSUMER_SECRET != '') {
                        $twpost = new TwitterSupport();
                        $twpost->post($path, $post->title, $post->url);
                    }

                //handle facebook
                if (Configuration::instance()->FB_APP_ID != '' && Configuration::instance()->FB_APP_SECRET != '' && Configuration::instance()->FB_ACCESS_TOKEN != '') {

                    $support = new FacebookSupport();
                    $pages = $support->post((string) Configuration::instance()->FB_ACCESS_TOKEN, $post->title, $post->url);
                }

                //handle instagram
                if (Configuration::instance()->INSTA_USERNAME != '' && Configuration::instance()->INSTA_PASSWORD != '') {
                    $igpost = new InstagramSupport();
                    $taglist = $post->tags->pluck('name')->toArray();
                    $igpost->post($taglist, $post->title, $post->excerpt, $path);
                }
            }
        }
    }
}
