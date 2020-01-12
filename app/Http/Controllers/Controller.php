<?php

namespace App\Http\Controllers;

use App\Model\Admin\Category;
use App\Model\Admin\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $view
     * @param array $parameters
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function renderView($view, array $parameters = array())
    {
//        $globalArray = array(
//            'menu' => Redis::get('Menu'),
//        );
//        $templateArray = array_merge($parameters,$globalArray);
        return view($view,$parameters);
    }

    /**
     * @param array $item
     * @return array
     */
    public function deleteEmptyField($item=array())
    {
        $arr = [];
        foreach($item as $k => $v){
            if($k != '_token' && $k != '_method' && $k != 'repass'){
                if(!empty($v) || $v == 0){
                    $arr[$k] = $v;
                }
            }
            if($k == 'password'){
                $arr[$k] = bcrypt($v);
            }
        }
        return $arr;
    }

    //用于批量删除 公共方法
    public function idDelete($id,$model)
    {
        $idArr = explode(',', $id);
        if(is_array($idArr) && count($idArr) > 1){
            array_pop($idArr);
            foreach($idArr as $v){
                $deleteRes = $model::destroy($v);
            }
        }else{
            $deleteRes = $model::destroy($id);
        }
        return $deleteRes;
    }
}
