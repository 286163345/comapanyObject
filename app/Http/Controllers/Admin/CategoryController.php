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
        $category = Category::paginate($this->limit);
        $category =  $this->quick_sort($category);
        dd($category);
        $params = array(
            'category' => $category,
            'message' => session('message')?session('message'):''
        );
        return view('admin.category.list',$params);
    }

    public function quick_sort($data, $fid = 0)
    {
        $result = array();
        foreach($data as $key => $val){
            if($fid == $val['fid']){
                $result[] = $val;
                foreach ($this->quick_sort($data, $val['id']) as $v) {
                    $result[] = $v;
                }
            }
        }
        return $result;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $fid = $request->get('fid');
        $params = array(
            'category' => null,
            'message' => session('message')?session('message'):''
        );
        if(!empty($fid)){
            $params['fid'] = $fid;
        }else{
            $params['fid'] = 0;
        }
        return view('admin.category.edit',$params);
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
        if(empty($id)){
            if(empty($data['fid'])){
                $data['fid'] = 0;
            }
            $data['status'] = 1;
            $data['order_by'] = 1;
            $category = Category::create($data);
        }else{
            $category = Category::where(['id'=>$id])->update($data);
        }
        if(!empty($category)){
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
        $category = $this->idDelete($id,new Category());
        if(!empty($category)){
            return response()->json(['message'=>'删除成功!']);
        }else{
            return response()->json(['error'=>'删除失败!']);
        }
    }
}
