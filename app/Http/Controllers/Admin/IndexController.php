<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User;

class IndexController extends Controller
{


    //后台首页
    public function index(Request $Request){
    	// $name = $Request->input('username');
    	// // $pwd = $Request->input('password');
    	
    	// $rs = User::where('username',$name)->value('username');
    	// dump($rs);die;
    	// if($rs){
    		// session(['username' => $rs]);
    		return view('admin/index');
    	// } else {
    	// 	return redirect('admin/login','rs'=>'用户名或密码错误');
    	// }
    	
    	
    }
}
