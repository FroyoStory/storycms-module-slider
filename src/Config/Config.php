<?php

namespace Story\Cms\Config;

use Story\Cms\Model;

class Config extends Model
{
    protected $table = 'configurations';
    protected $fillable = ['name', 'value'];
}
