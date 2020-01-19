<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';

    protected $guarded = [];

    public function imageAll () {
        return $this->hasOne('App\Model\Admin\ImageAll','banner_id');
    }
}
