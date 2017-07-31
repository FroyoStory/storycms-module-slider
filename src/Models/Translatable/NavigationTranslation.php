<?php

namespace Story\Cms\Models\Translatable;

use App;
use Story\Core\Model;
use Story\Cms\Models\Navigation;
use Illuminate\Support\Str;

class NavigationTranslation extends Model
{
    public $timestamps = false;

    protected $table    = 'trans_navigations';
    protected $fillable = ['name'];

    public function navigation()
    {
        return $this->belongsTo(Navigation::class);
    }
}
