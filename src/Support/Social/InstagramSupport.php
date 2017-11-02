<?php

namespace Story\Framework\Support\Social;

use Configuration;
use InstagramAPI\Instagram;
use Story\Framework\Contracts\StorySocial;

class InstagramSupport implements StorySocial
{
    protected $instagram;

    public function __construct()
    {
        $this->instagram = new Instagram();
    }

    public function post($title, $excerpt, $url = '', $path, $tags = array())
    {
        if ($this->validate()) {
            $loginResponse = $this->instagram->login((string) Configuration::instance()->INSTA_USERNAME, (string) Configuration::instance()->INSTA_PASSWORD);

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

                $posting = $this->instagram->timeline->uploadPhoto($path, $metadata);
            }
        }
    }

    public function validate()
    {
        return Configuration::instance()->INSTA_USERNAME != '' && Configuration::instance()->INSTA_PASSWORD != '';
    }
}
