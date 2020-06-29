<?php

namespace App\Http\Controllers\Admin;

use App\Model\Supervisor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

/**
 * Class SupervisorController
 * @package App\Http\Controllers\Admin
 * 超级管理员控制器
 */
class SupervisorController extends Controller
{
    /**
     * 获取用户列表
     * @return
     * admin/supervisor
     */
    public function index(Request $request)
    {
        //$input = $request->all();
        //dd($input);
        //这里是查询的方式 模糊查询的方式 和 排序的方式
        $supervisor = Supervisor::orderBy('supervisor_id','asc')->where(function ($query) use($request){
            $supervisor_name = $request->input('supervisor_name');
            $email = $request->input('email');
            if (!empty($supervisor_name)){
                $query->where('user_name','like','%'.$supervisor_name.'%');
            }
            if (!empty($email)){
                $query->where('email','like','%'.$email.'%');
            }
        })->paginate($request->input('num')?$request->input('num'):10);//排序

        //        $user= User::get();//获取所有数据
        // $user= User::paginate(5);//获取分页方式
        return view('admin.supervisor.list',compact('supervisor','request')); //把request也带到页面

    }

    /**
     * 返回用户添加页面
     * @return
     * admin/supervisor/create
     */
    public function create()
    {
        //
        return view('admin.supervisor.add');
    }

    /**
     * 执行添加操作
     * @param   $request
     * @return
     */
    public function store(Request $request)
    {

        //1.接收前台表单提交的数据
        //  email" => "xyzjg@123.com"
        //  "phone" => "13262851204"
        //  "supervisor_name" => "xyzjig"
        //  "supervisor_pass" => "123456"
        //  "supervisor_repass" => "123456"
        $input = $request->all();
        //dd($input);
        //2.进行表单验证

        // 3.添加到数据库的user表
        $supervisor_name = $input['supervisor_name'];
        $supervisor_pass = Crypt::encrypt($input['supervisor_pass']);
        $email = $input['email'];
        $phone = $input['phone'];
        $res =Supervisor::create(['supervisor_name'=>$supervisor_name,'supervisor_pass'=>$supervisor_pass,'email'=>$email,'phone'=>$phone]);
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
        $supervisor = Supervisor::find($id);
        return view('admin.supervisor.edit',compact('supervisor'));
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
        $supervisor = Supervisor::find($id);
//        获取要修改的用户名
        $supervisor_name = $request->input('supervisor_name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        $supervisor->supervisor_name = $supervisor_name;
        $supervisor->email = $email;
        $supervisor->phone = $phone;

        $res = $supervisor->save();

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

        $supervisor = Supervisor::find($id);
        $res = $supervisor->delete();
        if ($res){
            $data = [
                'status'=>0,
                'message'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'删除失败'
            ];
        }
        return $data;
    }

    /**
     * 删除所有选中的用户方法
     */
    public function dellALL(Request $request)
    {
        //返回一个用户ID数组
        $input = $request->input('ids');
        $res = Supervisor::destroy($input);//可以删除一个，也可以删除数组

        if ($res){
            $data = [
                'status'=>0,
                'message'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'删除失败'
            ];
        }
        return $data;

    }
}
