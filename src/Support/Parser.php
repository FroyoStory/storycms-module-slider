<?php

namespace Story\Cms\Support;

use DiDom\Document;
use DiDom\Query;
use DiDom\Element;

class Parser
{
    protected $heading = ['h3', '<div class="_header"><h3 class="_title"></div></div>'];

    public function get($string)
    {
        $document = new Document($string);
        $h1 = $document->find('h1');

        foreach ($document as $key => $value) {

        }
    }
}
