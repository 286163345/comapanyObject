<?php
/**
 * Created by PhpStorm.
 * User: 乔明明
 * Date: 2019/9/27
 * Time: 5:19
 */

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Category;

class BannerController extends Controller
{
    protected $limit = 15;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $banner = Banner::paginate($this->limit);
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
        $user = Category::find($id);
        $params = array(
            'fid' => empty($id)?0:$user['fid'],
            'category' => $user,
            'message' => session('message')?session('message'):''
        );
        return view('admin.category.edit',$params);
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
            $data['simg'] = $this->imageUpload('banner',$file);
        }
        if(empty($id)){
            $data['status'] = 1;
            $category = Banner::create($data);
        }else{
            $category = Banner::where(['id'=>$id])->update($data);
        }
        if(!empty($category)){
            return redirect('back/banner/'.$id.'/edit')->with('message', '修改成功!');
        }else{
            return redirect('back/banner/'.$id.'/edit')->with('message', '修改失败!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $category = $this->idDelete($id,new Category());
        if(!empty($category)){
            return response()->json(['message'=>'删除成功!']);
        }else{
            return response()->json(['error'=>'删除失败!']);
        }
    }
}
