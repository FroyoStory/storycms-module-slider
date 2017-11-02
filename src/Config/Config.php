<?php

namespace Story\Framework\Config;

use Story\Framework\Model;

class Config extends Model
{
    protected $table = 'configurations';
    protected $fillable = ['name', 'value'];
}
