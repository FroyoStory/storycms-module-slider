<?php

namespace Story\Cms\Listeners;

use Story\Cms\Events\PostCreated;
use Configuration;
use Story\Cms\Support\Social\FacebookSupport;
use Story\Cms\Support\Social\TwitterSupport;
use Story\Cms\Support\Social\InstagramSupport;

class PostToSocial
{
    protected $fb;
    protected $tw;
    protected $ig;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(FacebookSupport $fb, TwitterSupport $tw, InstagramSupport $ig)
    {
        $this->fb = $fb;
        $this->tw = $tw;
        $this->ig = $ig;
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

                //handle facebook
                $this->fb->post($tags = [], $post->title, '', $post->url, '');

                //handle twitter
                $this->tw->post($tags = [], $post->title, '', $post->url, $path);

                //handle instagram
                $tags = $post->tags->pluck('name')->toArray();
                $this->ig->post($tags, $post->title, $post->excerpt, '', $path);
            }
        }
    }
}
