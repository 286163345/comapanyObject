<?php
/**
 * Created by PhpStorm.
 * User: 乔明明
 * Date: 2019/9/27
 * Time: 5:19
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Category;

class CategoryController extends Controller
{
    protected $limit = 15;
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Category::paginate($this->limit);
        $params = array(
            'category' => $user,
            'message' => session('message')?session('message'):''
        );
        return view('admin.category.list',$params);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $params = array(
            'message' => session('message')?session('message'):''
        );
        return view('admin.category.add',$params);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $this->deleteEmptyField($request->all());
        $data['status'] = 1;
        $user = Category::create($data);
        if($user->id){
            return redirect('back/category')->with('message', '保存成功!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = Category::find($id);
        $params = array(
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
        $user = Category::where(['id'=>$id])->update($data);
        if(!empty($user)){
            return redirect('back/category/'.$id.'/edit')->with('message', '修改成功!');
        }else{
            return redirect('back/category/'.$id.'/edit')->with('message', '修改失败!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = Category::destroy($id);
        if(!empty($user)){
            return response()->json(['message'=>'删除成功!']);
        }else{
            return response()->json(['error'=>'删除失败!']);
        }
    }
}
