<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Admin\Message;
use App\Model\Admin\Poster;

class GerenController extends Controller
{
    //
    public function index()
    {
    	$uid = session('uid');
    	// 查出用户的详情
    	$res = DB::table('message')->where('uid',$uid)->first();
    	// 查看用户信息
    	$user = DB::table('users')->where('id',$uid)->first();
    	if ($res) {
    		return view('home.usersgeren.geren',['res'=>$res,'user'=>$user]);
    	} else {
    		return view('home.usersgeren.lnfo',['user'=>$user]);
    	}
    	
    }

    public function lnfo(Request $request)
    {
    	// 表单验证
        $this->validate($request, [
             'mname' => 'required',

            'address'=>'required',
            'email'=>'email',
            // 'body' => 'required',
        ],[
            'mname.required' => '昵称不能为空',

            'mname.unique' => '昵称已经存在',
            'address.required'=>'地址不能为空',
            'email.email'=>'邮箱格式不正确',
        ]);


        $rs = $request->except('_token','id');
        $rs['integral'] = 0;

          //处理图片上传
        if($request->hasFile('header')){

            //获取图片上传的信息
            $file = $request->file('header');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['header'] = '/uploads/'.$name.'.'.$suffix;

            //存放到数据库中
            $data = Message::create($rs);
            // dd($data);
            if($data){
            	return redirect('home/geren');
            } else {
            	return back();
            }
        }
    }

    public function xglnfo(Request $request)
    {
    	$uid = session('uid');
    	// 查出用户的详情
    	$res = DB::table('message')->where('uid',$uid)->first();
    	// 查看用户信息
    	$user = DB::table('users')->where('id',$uid)->first();
    	return view('home.usersgeren.xglnfo',['res'=>$res,'user'=>$user]);
    }

    public function xgfo(Request $request, $id)
    {
    	//删除头像
        $res = Message::find($id);
    	$arr = $request->except('_token','uid');
    	//处理头像
        if($request->hasFile('header')){
            $data = @unlink('.'.$res->header);
            if(!$data){
                return back()->with('error','修改失败');
            }
            //获取图片上传的信息
            $file = $request->file('header');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $arr['header'] = '/uploads/'.$name.'.'.$suffix;

        }
      	$uid = $request->input('uid');
      	$rs = Message::where('uid',$uid)->update($arr);
      	if($rs){
        	return redirect('home/geren');
      	} else {
        	return back();
      	}
    }
}
