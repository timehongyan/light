<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\Link;
use DB;
class LinkController extends Controller
{
    //
    public function index(){
    	$rs = DB::table('link')->where('status',1)->get();
    	//dump($rs);
    	return view('home/link/link',[
    	'rs'=>$rs,
    	]);

    }

    public function create()
    {
    	return view('home/link/create');
    }
    public function store(Request $request){
    	$rs = $request->except('_token');
    	$rs['addtime'] = time();
		 //处理图片上传
        if($request->hasFile('profile')){
            $file = $request->file('profile');

            $name='img_'.rand(1111,9999).time();
            //获取后缀
            $suffix = $file->getClientOriginalExtension();
            $file->move('./uploads',$name.'.'.$suffix);
            $rs['profile'] = '/uploads/'.$name.'.'.$suffix;
        }

        //dd($rs);

    	$data = Link::create($rs);
    	 if($data){
            return redirect('home/link/list');
        }else{
            return back();
        }
    	//dump($rs);
    	//$data = Link::create($rs)
    	
    	
    }

    public function list()
    {

        $rs = DB::table('link')->where('status',0)->get();
        return view('home/link/list',[
            'rs'=>$rs,
        ]);  
      }
   
}
