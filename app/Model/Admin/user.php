<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
     //
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'users';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];

     /**
     *  用户和角色的关联
     *
     * @return \Illuminate\Http\Response
     */
    public function user_role()
    {
        return $this->belongsToMany('App\Model\Admin\Role','user_role', 'userid', 'roleid');
    }


}
