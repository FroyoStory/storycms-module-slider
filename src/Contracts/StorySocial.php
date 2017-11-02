<?php

namespace Story\Framework\Contracts;

interface StorySocial
{
    public function post($title, $excerpt = '', $url = '', $imagelink = '', $tags = array()) {}
}
