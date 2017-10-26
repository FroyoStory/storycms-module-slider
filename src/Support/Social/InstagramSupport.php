<?php

namespace Story\Cms\Support\Social;

use Configuration;
use InstagramAPI\Instagram;
use Story\Cms\Contracts\StorySocial;

class InstagramSupport implements StorySocial
{
    protected $ig;

    public function __construct()
    {
        $this->ig = new Instagram();
    }

    public function post($tags = array(), $title, $excerpt, $url = '', $path)
    {
        if ($this->validate()) {
            $loginResponse = $this->ig->login((string) Configuration::instance()->INSTA_USERNAME, (string) Configuration::instance()->INSTA_PASSWORD);

            if ($path != '') {
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
    }

    public function validate()
    {
        return Configuration::instance()->INSTA_USERNAME != '' && Configuration::instance()->INSTA_PASSWORD != '';
    }
}
