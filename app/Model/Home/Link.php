<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //
    //
    protected $table = 'link';


    protected $primarykey = 'id';


    public $timestamps = false;


    //不可被批量赋值的属性
    protected $guarded = [];
}
