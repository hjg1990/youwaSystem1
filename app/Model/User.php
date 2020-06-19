<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //1.关联数据表
    public $table = 'user';

    //2.主键
    public $primaryKey ='user_id';

    //3.允许操作字段
    public $fillable = ['user_name','user_pass','email','phone'];
    public $guarded=[];//不允许操作字段
    //4.是否维护created_at 和 updated_at
    //public $timestamps = false;

}
