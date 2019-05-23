<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
     //
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'role';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
