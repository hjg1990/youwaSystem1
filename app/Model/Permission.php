<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * @package App\Model
 * 权限模型表
 */
class Permission extends Model
{
    //
    //1.表名称
    public $table = "permission";
    //2.主键
    public $primaryKey = "id";

    //3.允许操作字段
   // public $fillable = ['user_name','user_pass','email','phone'];
    public $guarded=[];//不允许操作字段
    //4.是否维护created_at 和 updated_at
    public $timestamps = false;
}
