<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Admin\User;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function ajaxs()
    {
    	$id = $_GET['id'];
    	$sta = $_GET['sta'];

    	// echo $sta;
    	// if($sta == 1){
    		$rs = User::where('id',$id)->update(['status'=>$sta]);
    		
    		// if($rs > 0){
    		// 	echo 1;
    		// } else {
    		// 	echo 0;
    		// }
    	// }
    	// $rs = User::where('id',$id)->update();
    	// dump($rs);
    }
}
