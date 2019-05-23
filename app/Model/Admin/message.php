<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
      //
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'message';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
