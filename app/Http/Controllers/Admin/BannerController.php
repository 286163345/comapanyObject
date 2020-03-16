<?php
/**
 * Created by PhpStorm.
 * User: 乔明明
 * Date: 2019/9/27
 * Time: 5:19
 */

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Banner;
use App\Model\Admin\ImageAll;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    protected $limit = 15;
    private $bannerModel;
    public function __construct()
    {
        $this->bannerModel = new Banner();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $banner = $this->bannerModel->newQuery()->select("*")
            ->leftJoin('image_all as i','i.banner_id','=','banner.id')
            ->paginate($this->limit);
//        $banner = $this->bannerModel->imageAll()
//            ->toSql();
//        dd($banner);
        $params = array(
            'banner' => $banner,
            'message' => session('message')?session('message'):''
        );
        return view('admin.banner.list',$params);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $params = array(
            'banner' => null,
            'message' => session('message')?session('message'):''
        );
        return view('admin.banner.edit',$params);
    }

//    /**
//     * @param Request $request
//     * @return \Illuminate\Http\RedirectResponse
//     */
//    public function store(Request $request)
//    {
//        $data = $this->deleteEmptyField($request->all());
//        $data['status'] = 1;
//        $user = Category::create($data);
//        if($user->id){
//            return redirect('back/category')->with('message', '保存成功!');
//        }
//    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $bannerImage = Banner::find($id)->imageAll;
        $bannerRes = Banner::find($id);
        $banner = &$bannerRes;
        $banner['images'] = $bannerImage->images;
        $params = array(
            'banner' => $banner,
            'message' => session('message')?session('message'):''
        );
        return view('admin.banner.edit',$params);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $this->deleteEmptyField($request->all());
        $file = $request->file("file");
        if(!empty($file)){
            $data['images'] = $this->imageUpload('banner',$file);
        }
        if(empty($id)){
            $data['status'] = 1;
            $banner = Banner::create($data);
            if($banner && !empty($file)){
                $data['banner_id'] = $banner['id'];
                ImageAll::imageUpdate($data,'banner');
            }
            if($banner){
                return redirect('back/banner/create')->with('message', '添加成功!');
            }else{
                return redirect('back/banner/create')->with('message', '添加失败!');
            }
        }else{
            $content = array();
            $content['href'] = $data['href'];
            $content['notes'] = $data['notes'];
            $banner = Banner::where('id',$id)->update($content);
            if(!empty($file)){
                $data['banner_id'] = $id;
                ImageAll::imageUpdate($data,'banner',true);
            }
            if($banner){
                return redirect('back/banner/'.$id.'/edit')->with('message', '修改成功!');
            }else{
                return redirect('back/banner/'.$id.'/edit')->with('message', '修改失败!');
            }

        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = $this->idDelete($id,new Banner());
        if(!empty($user)){
            return response()->json(['message'=>'删除成功!']);
        }else{
            return response()->json(['error'=>'删除失败!']);
        }
    }
}
