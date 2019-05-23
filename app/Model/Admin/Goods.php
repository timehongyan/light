<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';
    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    protected $primaryKey = 'id';

    /**
	 * 不可被批量赋值的属性。
	 *
	 * @var array
	 */
	protected $guarded = [];

    public function gm()
    {
        return $this->hasMany('App\Model\Admin\Goodspicture', 'gid', 'id');
    }
}
