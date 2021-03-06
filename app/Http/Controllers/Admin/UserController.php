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
use App\Model\Admin\User;

class UserController extends Controller
{
    protected $limit = 15;
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = User::paginate($this->limit);
        $params = array(
            'user' => $user,
            'message' => session('message')?session('message'):''
        );
        return view('admin.user.list',$params);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $params = array(
            'user' => null,
            'message' => session('message')?session('message'):''
        );
        return view('admin.user.edit',$params);
    }

    //添加编辑更新共用update方法
//    /**
//     * @param Request $request
//     * @return \Illuminate\Http\RedirectResponse
//     */
//    public function store(Request $request)
//    {
//        $data = $this->deleteEmptyField($request->all());
//        $user = User::create($data);
//        if($user->id){
//            return redirect('back/user/create')->with('message', '保存成功!');
//        }
//    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);
        $params = array(
            'user' => $user,
            'message' => session('message')?session('message'):''
        );
        return view('admin.user.edit',$params);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //TODO 需要验证邮箱   缺少token
        $data = $this->deleteEmptyField($request->all());
        if(empty($id)){
            $user = User::create($data);
        }else{
            $user = User::where(['id'=>$id])->update($data);
        }
        if(!empty($user)){
            return redirect('back/user/'.$id.'/edit')->with('message', '修改成功!');
        }else{
            return redirect('back/user/'.$id.'/edit')->with('message', '修改失败!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = $this->idDelete($id,new User());
        if(!empty($user)){
            return response()->json(['message'=>'删除成功!']);
        }else{
            return response()->json(['error'=>'删除失败!']);
        }
    }
}
