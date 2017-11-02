<?php

namespace Story\Framework;

class Story
{
    public function user()
    {
        return \Auth::user();
    }
}
