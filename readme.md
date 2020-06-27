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

### html:5 再按table键 快速生成html模板

### git remote add origin https://github.com/hjg1990/pr2017.git 在远程github创建一个仓库 建立连接
###    git push -u origin master   上传本地代码到远程仓库
###  git add . 添加
###  git commit -m "描述一个页面"

