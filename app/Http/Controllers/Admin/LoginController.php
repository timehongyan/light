<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormlRequest;

use Gregwar\Captcha\CaptchaBuilder;
use App\Model\Admin\Message;

use DB;
use Hash;

use Session;

class LoginController extends Controller
{
    public function login()
    {

        // $rs =  DB::table('users')
        // ->join('message','users.id','=','message.uid')
        
        // ->select('users.*','message.header')
        // ->where('users.id','=','7')
        // ->first();、
        
    	return view('admin.login',['title'=>'后台登录页面']);
    }


      /**
     * 处理登录的信息
     *
     * @return \Illuminate\Http\Response
     */
    public function dologin(Request $request)
    {

    	// dump($request->all());
    	//表单验证

    	// 先获取用户名
    	$um = $request->username;
        // var_dump($um);die;
    	//根据用户名作对比
    	$rs = DB::table('users')->where('username',$um)->first();

        if(!$rs){

        return back()->with('error','用户名或密码错误');
      }
    	

        //判断用户状态
        if(!$rs->status == 1){
            return back()->with('error', '此账号已禁用');
        }
    	

    	//对比密码
    	$pass = $rs->password;

    	if(!Hash::check($request->password,$pass)){

			return back()->with('error','用户名或密码错误');
    	}
    	//验证码
    	$code = session('code');
    	if($code != $request->code){

    		return back()->with('error','验证码错误');
    	}

    	//存储用户信息
    	session(['uid'=>$rs->id]);


    	return redirect('/admins')->with('success','登录成功');
    }

    /**
     * 验证码
     *
     * @return \Illuminate\Http\Response
     */
    public function captcha()
    {
    	//生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 35, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        // Session::flash('milkcaptcha', $phrase);
        session(['code'=> $phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

       /**
     * Ajax修改头像
     *
     * @return \Illuminate\Http\Response
     */
    public function header(Request $request)
    {
        $rs =  DB::table('users')
        ->join('message','users.id','=','message.uid')
        
        ->select('users.*','message.header')
        ->where('users.id','=',session('uid'))
        ->first();
        $id = session('uid');
        if($rs){
           return view('admin.header',[
            'title'=>'修改头像',
            'rs'=>$rs
          ]);
        } else {
          return redirect("admins/user/info/$id")->with('error','请上传头像');
        }
       
    }

      /**
     * 处理数据Ajax修改头像
     *
     * @return \Illuminate\Http\Response
     */
      public function upload(Request $request)
      {

        $res = Message::where('uid',session('uid'))->first();
        unlink('./'.$res->header);
        $file = $request->file('file_upload');

        //名字
        $name = 'img_'.rand(1111,9999).time();

        //获取后缀
        $suffix = $file->getClientOriginalExtension();

        $file->move('./uploads',$name.'.'.$suffix);

        echo '/uploads/'.$name.'.'.$suffix;


        //修改数据表里面的信息
        $rs['header'] = '/uploads/'.$name.'.'.$suffix;



        DB::table('message')->where('uid',session('uid'))->update($rs);



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


       /**
     * 修改密码页面
     *
     * @return \Illuminate\Http\Response
     */
    public function pass()
    {
       
      return view('admin/pass',['title'=>'修改密码页面']);
    }


      /**
     * 修改密码页面
     *
     * @return \Illuminate\Http\Response
     */
    public function dopass(Request $request)
    {
      // 表单验证
      $this->validate($request, [

          'password' => 'required|regex:/^\S{8,16}$/',
          'repass'=>'same:password',

          // 'body' => 'required',
      ],[

          'password.required'=>'密码不能为空',
          'password.regex'=>'密码格式不正确',
          // 'repass.required'=>'确认密码不能为空',
          'repass.same'=>'两次密码不一致',
      ]);

        //获取旧密码
      $pass = $request->oldpass;

      //获取当前用户的信息
      $rs = DB::table('users')->where('id',session('uid'))->first();

      //Hash
      if(!Hash::check($pass,$rs->password )){

        return back()->with('error','旧密码有误');
      }

      //两次密码一致
      $res['password'] = Hash::make($request->password);

      $data = DB::table('users')->where('id',session('uid'))->update($res);

      if($data){
        //清空session
        session(['uid'=>'']);

        return redirect('/admins/login');
      } else {

        return back();
      }
    }



    /**
     * 后台退出
     *
     * @return \Illuminate\Http\Response
     */
    
    public function logout()
    {
       //清除session
      session::forget('uid');
        // dump(session('uid'));
        // die;

        //重定向
        return redirect('/admins/login')->with('success','退出成功');
    }

  
    public function ceshi()
    {
      echo "中间件";
    }

}
