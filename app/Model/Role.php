<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Model
 * 角色模型表
 */
class Role extends Model
{
    //1.表名称
    public $table = "role";
    //2.主键
    public $primaryKey = "id";

    //3.允许操作字段
    //public $fillable = ['user_name','user_pass','email','phone'];
    public $guarded=[];//不允许操作字段
    //4.是否维护created_at 和 updated_at
    //public $timestamps = false;

}
