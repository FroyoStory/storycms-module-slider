<?php

namespace Story\Cms\Backend\Http\Requests;

use Story\Core\Request;

class PostRequest extends Request
{
    public function rules()
    {
        return [
            'title' => 'required'
        ];
    }
}
