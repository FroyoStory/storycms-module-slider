<?php

namespace Story\Framework\Support\Plugins;

use Story\Framework\Model;

class Plugin extends Model
{
    const INSTALLED = 1;
    const UNINSTALLED = 0;

    protected $table = 'plugins';
    protected $fillable = [
        'user_id', 'name', 'description', 'status', 'providers'
    ];

    public $casts = [
        'providers' => 'array'
    ];

    /**
     * Flag the given plugin to installed
     *
     * @return bool
     */
    public function install()
    {
        if ($this->status == self::UNINSTALLED) {
            $this->status = self::INSTALLED;
            return $this->save();
        }
        return false;
    }

    /**
     * Flag the given plugin to uninstalled
     *
     * @return bool
     */
    public function uninstall()
    {
        if ($this->status == self::INSTALLED) {
            $this->status = self::UNINSTALLED;
            return $this->save();
        }
        return false;
    }
}
