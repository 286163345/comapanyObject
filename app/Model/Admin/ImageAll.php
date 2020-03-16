<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ImageAll extends Model
{
    protected $table = 'image_all';

    protected $guarded = [];

    public function banner()
    {
        return $this->belongsTo('App\Model\Admin\User');
    }

    /**
     * 更新图片到imgAll模型
     * @param $data
     * @param $type
     * @param $imageId
     * @return |null
     */
    public static function imageUpdate($data, $type, $update = false)
    {
        $content = array();
        $res = null;
        if(!empty($data['images']) && !$update){
            $content['type'] = strtolower($type);
            $content['images'] = $data['images'];
            $content['banner_id'] = $data['banner_id'];
            $res = ImageAll::create($content);
        }else{
            $banner = ImageAll::where('banner_id',$data['banner_id'])->get()[0];
            $fileName = str_replace('/storage/','',$banner->images);
            Storage::disk('public')->delete($fileName);
            $banner->images = $data['images'];
            $banner->save();
//            $content['type'] = strtolower($type);
//            $content['images'] = $data['images'];
//            $res = ImageAll::where(['banner_id'=>$data['banner_id']])->update($content);
        }
        return $res;
    }
}
