<?php

namespace App\Http\Controllers\Admin;

use App\Model\Supervisor;
use App\Model\User;
use App\Org\code\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //后台登录页
    public function login()
    {
        return view('admin.login');
    }

    /**
     * @return Code
     * 验证吗的方法
     */
    public function code()
    {
        $code = new Code();
        return $code->make();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     * 后台登录后的总页面
     */
    public function index()
    {
        return view('admin.index');
    }


    /**
     * @param Request $request
     * 处理用户登录的方法
     */
    public function doLogin(Request $request)
    {

//      1.接收表单提交的数据
        $input = $request->except('_token');
        //2.表单验证
//        Validator::make(需要验证的表单数据,验证规则，错误提示）
        $rule = [
            'supervisor_name'=>'required|between:4,18',
            'supervisor_pass'=>'required|between:4,18,alpha_dash'
        ];
         $msg = [
             'supervisor_name.required'=>'用户名不能为空',
             'supervisor_name.between'=>'用户名必须输入4-18位之间',
             'supervisor_pass.required'=>'密码不能为空',
             'supervisor_pass.between'=>'密码必须输入4-18位之间',
             'supervisor_pass.alpha_dash'=>'密码必须是数字或下划线',
         ];
         //表单验证类
        $validator = Validator::make($input,$rule,$msg) ;
//        验证失败返回
        if ($validator->fails()){
            return redirect('admin/login')
                   ->withErrors($validator)
                   ->withInput();
        }
//        3.验证是否由此用户登录（验证码,用户名，密码，）
          $supervisor = Supervisor::where('supervisor_name',$input['supervisor_name'])->first();
        //strtolower大小写验证码
         if (strtolower($input['code']) != strtolower(session()->get('code'))){
             return redirect('admin/login')->with('errors','验证码不正确');
         }
          if (!$supervisor){
              return redirect('admin/login')->with('errors','用户名不正确');
         }
          if($input['supervisor_pass'] != Crypt::decrypt($supervisor->supervisor_pass)){
              return redirect('admin/login')->with('errors','密码不正确');
          }
//        4.保存用户信息到session中
        session()->put('supervisor',$supervisor);

//        5.跳转到后台首页
          return redirect('admin/index');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页欢迎路由
     */
    public function welcome()
    {
        return view('admin/welcome');
    }

    //退出登录功能
    public function logout()
    {
         //清空session的用户信息
         session()->flush();
         //跳转到登录页面
         return redirect('admin/login');

    }


    /**
     * @return mixed
     * //加密算法
     */
    public function jiami()
    {
//        1.md5加密
          $str = '123456';
//        return md5($str);//md5加密

        //2.hash加密
        $hash = Hash::make($str); //哈希加密
        //验证是否成功
//         if (Hash::check($str,$hash)){
//            return "密码正确";
//         }else{
//             return "密码错误";
//         }

//         3.crypt加密
          $str1 = '123456';
         $crypt_str = Crypt::encrypt($str1);
         return $crypt_str;
         //crypt解密
//          $str2 = "eyJpdiI6IkUzMzRcL1NXSEpLRnRvOGNRbTBOYlBRPT0iLCJ2YWx1ZSI6Ikl2alZTSUZaSk1BS3E0TmMzTjNKM0E9PSIsIm1hYyI6ImNhYjQ1NTYwYmQ2MjE5ZTkxYjRkNWM0ZjNmMWUzZGMyMjBlYzVhZGZlNDU5MDU5OWQ0M2M5Y2M0ZTM3Y2MyODEifQ==";
//          return  Crypt::decrypt($str2);

    }




}
