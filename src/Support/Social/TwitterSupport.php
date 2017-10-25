<?php

namespace Story\Cms\Support\Social;

use Configuration;
use TwitterAPIExchange;

class TwitterSupport
{
    protected $setting;

    protected $url;

    protected $uploadurl;

    public function __construct()
    {
        $this->setting = array(
                    'oauth_access_token' => (string) Configuration::instance()->TW_ACCESS_TOKEN,
                    'oauth_access_token_secret' => (string) Configuration::instance()->TW_ACCESS_TOKEN_SECRET,
                    'consumer_key' => (string) Configuration::instance()->TW_CONSUMER_KEY,
                    'consumer_secret' => (string) Configuration::instance()->TW_CONSUMER_SECRET
        );

        $this->url = 'https://api.twitter.com/1.1/statuses/update.json';
        $this->uploadurl = 'https://upload.twitter.com/1.1/media/upload.json';
    }

    public function post($path, $title, $url)
    {
                $requestMethod = 'POST';

                if ($path != '') {
                    $imagefield = array(
                        'media_data' => base64_encode(file_get_contents($path))
                    );

                    $twitterimage = new TwitterAPIExchange($this->setting);
                    $imgfile = $twitterimage->buildOauth($this->uploadurl, $requestMethod)
                                            ->setPostfields($imagefield)
                                            ->performRequest();

                    $image = json_decode($imgfile);
                    $postfields = array(
                        'status'    => $title. ' ' .$url,
                        'media_ids' => $image->media_id_string
                    );
                } else {
                    $postfields = array(
                        'status'    => $title. ' ' .$url
                    );
                }

                $twitter = new TwitterAPIExchange($this->setting);
                $twitter->buildOauth($this->url, $requestMethod)
                        ->setPostfields($postfields)
                        ->performRequest();
    }
}
