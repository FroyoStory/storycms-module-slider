<?php

namespace Story\Cms\Support\Social;

use Configuration;
use InstagramAPI\Instagram;

class InstagramSupport
{

    protected $ig;

    public function __construct()
    {
        $this->ig = new Instagram();
    }

    public function post($tags = array(), $title, $excerpt, $path)
    {
        $loginResponse = $this->ig->login((string) Configuration::instance()->INSTA_USERNAME, (string) Configuration::instance()->INSTA_PASSWORD);

        if (count($tags) == 0 || $tags == '') {
            $tagstring = '';
        } else {
            $stripspace = str_replace(' ', '_', $tags);
            $tagstring = '#'.implode(" #", $stripspace);
        }

        $metadata = [
            'caption' => $title ."\n". $excerpt . "\n" . $tagstring,
        ];

        $posting = $this->ig->timeline->uploadPhoto($path, $metadata);
    }
}
