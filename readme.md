## 使用说明

- composer create-project --prefer-dist laravel/laravel youwaMember "5.5.*"
在文件夹下新建一个laravel的方法 没有vendor要执行composer update

- php artisan key:generate  运行生成key

创建控制器命令
- php artisan make:controller Admin\LoginController

- app/org/code 验证码的方法类
- use App\Org\code\Code; 加载完之后
- 执行composer dump-autoload 自动加载

创建一个数据库模型
- php artisan make:model Model\User

//创建一个资源路由  自动生成增删改查功能
- php artisan make:controller Admin\UserController --resource

用户相关路由的显示
- php artisan route:list
###-------------------------------------
####post laravel5.5 csrf验证
<a>https://learnku.com/docs/laravel/5.5/csrf/1295<a/>
- ajax中post提交的token值
- {{--表达验证 post提交token--}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
-  //ajax提交 token 在上面的代码中meta添加
-  $.ajaxSetup({
       headers:{
           'X-CSRF-TOKEN' : $('meta[name="csrf-token]').attr('content')
          }
            })          
###===============================
### 监听submit提交
-  按钮点击或者表单被执行提交时触发，其中回调函数只有在验证全部通过后才会进入，回调返回三个成员：

- form.on('submit(*)', function(data){
-    console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
-    console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
-    console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
-    return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
-  });


##权限原理RBAC
1
-  user 用户表        id  username   pass
-  user_role 用户角色关联表  user_id   role_id
-  role 角色表        id  role_name（系统管理员，部门经理）  created_at  updated_at deleted_at
-  role_permisson 角色权限关联表  role_id  permisson_id
-  permisson 权限表   id  per_name（用户修改权限）   per_url(路由地址App\Http\Controllers\Admin\UserController@edit)

2,创建用户模型  角色模型  权限模型  php artisan make:model Model\Role
3.角色路由 //角色路由
           Route::resource('role','RoleController');
           php artisan make:controller Admin\RoleController  --resource
4.          











### html:5 再按table键 快速生成html模板

###  git init 在空文件夹中使用后可以生成一个.git的文件夹 就是工作区
###  git remote add origin https://github.com/hjg1990/pr2017.git 在远程github创建一个仓库 建立连接
###  git push -u origin master   上传本地代码到远程仓库
###  git add . 添加
###  git commit -m "描述一个页面"
###  git push 上传页面 
###  git status 查看状态
###  git push origin master  代码上传两次
###  git reflog 获取所有的提交记录   
###  git reset --hard HEAD @ {n}，按Enter键确认  回退版本方法