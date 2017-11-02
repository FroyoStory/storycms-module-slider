<?php

namespace Story\Framework\Listeners;

use Story\Framework\Events\PostCreated;
use Configuration;
use Story\Framework\Support\Social\FacebookSupport;
use Story\Framework\Support\Social\TwitterSupport;
use Story\Framework\Support\Social\InstagramSupport;

class PostToSocial
{
    protected $facebook;
    protected $twitter;
    protected $instagram;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(FacebookSupport $facebook, TwitterSupport $twitter, InstagramSupport $instagram)
    {
        $this->facebook = $facebook;
        $this->twitter = $twitter;
        $this->instagram = $instagram;
    }

    /**
     * Handle the event.
     *
     * @param  PostCreated  $post
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $post       = $event->post;
        $request    = $event->request;

        if (Configuration::instance()->SWITCH == '1') {
            if($request->input('post_status') == 'publish') {

                $path = $this->getImagePath($post);
                $tags = $post->tags->pluck('name')->toArray();

                //handle facebook
                $this->facebook->post($tags = [], $post->title, '', $post->url, '');
                $this->twitter->post($tags = [], $post->title, '', $post->url, $path);
                $this->instagram->post($tags, $post->title, $post->excerpt, '', $path);
            }
        }
    }

    /**
     * Get image path
     *
     * @param  \Story\Framework\Contracts\StoryPost $post
     * @return bool|string
     */
    protected function getImagePath($post)
    {
        if ($post->meta->featured_image) {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                return public_path().str_replace("/", "\\", $post->meta->featured_image);
            }
            return public_path().$post->meta->featured_image;
        }

        return null;
    }
}
