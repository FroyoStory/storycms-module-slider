<?php

namespace Story\Cms\Contracts;

interface StorySocial
{
    public function post($tags = array(), $title, $excerpt = '', $url = '', $imagelink = '') {}
}
