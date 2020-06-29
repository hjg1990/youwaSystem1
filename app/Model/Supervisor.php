<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Supervisor
 * @package App\Model
 * 超级管理员模型
 */
class Supervisor extends Model
{
    //
    //1.关联数据表
    public $table = 'supervisor';

    //2.主键
    public $primaryKey ='supervisor_id';

    //3.允许操作字段
    //public $fillable = ['user_name','user_pass','email','phone'];
    public $guarded=[];//不允许操作字段
    //4.是否维护created_at 和 updated_at
    //public $timestamps = false;
}
