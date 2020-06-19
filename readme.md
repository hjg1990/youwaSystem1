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


### html:5 再按table键 快速生成html模板

