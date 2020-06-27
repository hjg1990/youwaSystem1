<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * 获取用户列表
     * @return
     * admin/user
     */
    public function index(Request $request)
    {
        $input = $request->all();
        //dd($input);
        //模糊查询的方式 和 排序的方式
        $user = User::orderBy('user_id','asc')->where(function($query) use($request){
              $username = $request->input('username');
              $email = $request->input('email');
              if (!empty($username)){
                  $query->where('user_name','like','%'.$username.'%');
              }
             if (!empty($email)){
                $query->where('email','like','%'.$email.'%');
             }
        })->paginate($request->input('num')?$request->input('num'):5);//排序

//        $user= User::get();//获取所有数据
       // $user= User::paginate(5);//获取分页方式
        return view('admin.user.list',compact('user','request')); //把request也带到页面

    }

    /**
     * 返回用户添加页面
     * @return
     * admin/user/create
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
        $phone = $input['phone'];
        $res = User::create(['user_name'=>$username,'user_pass'=>$pass,'email'=>$email,'phone'=>$phone]);
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
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
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
        //根据id获取要修改的记录
        $user = User::find($id);
//        获取要修改的用户名
        $username = $request->input('username');
        $email = $request->input('email');
        $phone = $request->input('phone');

        $user->user_name = $username;
        $user->email = $email;
        $user->phone = $phone;

        $res = $user->save();

        if ($res){
            $data = [
                'status' => 0,
                'message' =>"修改成功",
            ];
        }else{
            $data = [
                'status' => 1,
                'message' =>"修改失败",
            ];
        }
        return $data;
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
