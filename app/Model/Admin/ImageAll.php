<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class ImageAll extends Model
{
    protected $table = 'image_all';

    protected $guarded = [];

    public function banner()
    {
        return $this->belongsTo('App\Model\Admin\User');
    }

    /**
     * @param $data
     * @param $type
     * @return |null
     * 更新图片到imgAll模型
     */
    public static function imageAdd($data, $type)
    {
        $content = array();
        $res = null;
        if(!empty($data['simg'])){
            $imgkey = strtolower($type).'_id';
            $content['images'] = $data['simg'];
            $content['type'] = $type;
            $content[$imgkey] = $data['bind_id'];
            $res = ImageAll::create($content);
        }
        return $res;
    }
}
