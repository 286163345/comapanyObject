<?php
/**
 * Created by PhpStorm.
 * User: 乔明明
 * Date: 2019/9/27
 * Time: 5:19
 */

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Banner;
use App\Model\Admin\PhotoWall;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Category;

class PhotoWallController extends Controller
{
    protected $limit = 15;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $photoWall = PhotoWall::paginate($this->limit);
        $params = array(
            'photoWall' => $photoWall,
            'message' => session('message')?session('message'):''
        );
        return view('admin.photowall.list',$params);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $params = array(
            'photoWall' => null,
            'message' => session('message')?session('message'):''
        );
        return view('admin.photowall.edit',$params);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $photoWall = PhotoWall::find($id);
        $params = array(
            'photoWall' => $photoWall,
            'message' => session('message')?session('message'):''
        );
        return view('admin.photowall.edit',$params);
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
            $data['simg'] = $this->imageUpload('photowall',$file);
        }
        if(empty($id)){
            $data['status'] = 1;
            $category = PhotoWall::create($data);
        }else{
            $category = PhotoWall::where(['id'=>$id])->update($data);
        }
        if(!empty($category)){
            return redirect('back/photoWall/'.$id.'/edit')->with('message', '修改成功!');
        }else{
            return redirect('back/photoWall/'.$id.'/edit')->with('message', '修改失败!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = $this->idDelete($id,new PhotoWall());
        if(!empty($user)){
            return response()->json(['message'=>'删除成功!']);
        }else{
            return response()->json(['error'=>'删除失败!']);
        }
    }
}
