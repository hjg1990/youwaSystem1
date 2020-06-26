<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 获取用户列表
     * @return
     */
    public function index()
    {
        return view('admin.user.list');

    }

    /**
     * 返回用户添加页面
     * @return
     */
    public function create()
    {
        //
        return view('admin.user.add');
    }

    /**
     * 执行添加操作
     * @param   $request
     * @return
     */
    public function store(Request $request)
    {

        //1.接收前台表单提交的数据  username pass repass email
        $input = $request->all();
        //dd($input);
        //2.进行表单验证

        // 3.添加到数据库的user表
        $username = $input['username'];
        $pass = Crypt::encrypt($input['pass']);
        $email = $input['email'];

        $res = User::create(['user_name'=>$username,'user_pass'=>$pass,'email'=>$email]);

         //4.根据添加是否成功，给用户一个json格式的反馈
        if ($res){
            $data = [
              'status' => 0,
              'message'=>'添加成功'
            ];
        }else{
            $data = [
              'status'  => 1,
              'message' => '添加失败'
            ];
        }
        //返回json的数据
         return $data;
    }

    /**
     * 显示一条数据
     *
     * @param  int  $id
     * @return
     */
    public function show($id)
    {
        //
    }

    /**
     * 返回修改页面
     *
     * @param  int  $id
     * @return
     */
    public function edit($id)
    {
        //
    }

    /**
     * 执行修改操作
     *
     * @param    $request
     * @param    $id
     * @return
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 执行删除操作
     *
     * @param  int  $id
     * @return
     */
    public function destroy($id)
    {
        //
    }
}
