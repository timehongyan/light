<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User;
use DB;
use App\Model\Admin\Message;

class InfoController extends Controller
{
    //
   	public function create($id)
   	{
   		return view('admin/user/info',['title'=>'用户详情添加页面','uid'=>$id]);
   	}

   	public function store(Request $request){
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


        $rs = $request->except('_token');
        $rs['integral'] = 0;

          //处理图片上传
        if($request->hasFile('header')){

            //获取图片上传的信息
            $file = $request->file('header');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads/users',$name.'.'.$suffix);

            $rs['header'] = '/uploads/users/'.$name.'.'.$suffix;

            //存放到数据库中
            $data = Message::create($rs);
            if($data){
            	return redirect('admins/user');
            } else {
            	return back();
            }
        }
   	}

   	//处理修改用户详情

   	//修改头像页面
   	public function header($id)
   	{
   		$rs =  DB::table('users')
        ->join('message','users.id','=','message.uid')
        
        ->select('users.*','message.header')
        ->where('users.id','=',$id)
        ->first();
        // dump($rs);die;
        return view('admin.user.headers',[
            'title'=>'列表页修改头像',
            'rs'=>$rs,
            'id'=>$id
        ]);
   	}


   	public function uploads(Request $request)
   	{	
   		$id = $request->input('id');
   		$res = Message::where('uid',$id)->first();
   		// dump($res->header);die;
        unlink('.'.$res->header);
        
        $file = $request->file('file_upload');

        //名字
        $name = 'img_'.rand(1111,9999).time();

        //获取后缀
        $suffix = $file->getClientOriginalExtension();

        $file->move('./uploads/users',$name.'.'.$suffix);

        echo '/uploads/users/'.$name.'.'.$suffix;


        //修改数据表里面的信息
        $rs['header'] = '/uploads/users/'.$name.'.'.$suffix;



        DB::table('message')->where('uid',$id)->update($rs);



        //获取上传的文件对象
       /* $file = Input::file('file_upload');
        //判断文件是否有效
        if($file->isValid()){
            $entension = $file->getClientOriginalExtension();//上传文件的后缀名
            $newName = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
            $path = $file->move(base_path().'/uploads',$newName);
            $filepath = 'uploads/'.$newName;
            //返回文件的路径
            return  $filepath;
        }*/
   	}

    public function edit($id)
    {
       $rs = Message::where('uid',$id)->first();
        return view('admin//user/infoedit',['title'=>'用户详情页面','rs'=>$rs,'uid'=>$id]);
    }

    public function infoupdate(Request $request)
    {
      $uid = $request->input('uid');
      $res = Message::where('uid',$uid)->first();

      $arr = $request->except('_token','uid');

         //处理图片上传
        if($request->hasFile('header')){
            unlink('.'.$res->header);
            //获取图片上传的信息
            $file = $request->file('header');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads/users',$name.'.'.$suffix);

            $arr['header'] = '/uploads/users/'.$name.'.'.$suffix;

            //存放到数据库中
        }

      

      $rs = Message::where('uid',$uid)->update($arr);
      if($rs){
        return redirect('/admins/user')->with('success','用户详情修改成功');
      } else {
        return back();
      }
    }
}
