<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Ucpaas;
use Hash;
use Session;

use Gregwar\Captcha\CaptchaBuilder;

class RegistController extends Controller
{
    public function regist()
    {
    	return view('home.regist.zhuce');
    }

    //查看用户是否以存在
    public function checkuser(Request $request)
    {
    	$res = $request->input('tv');
		//跟数据库进行匹配账号
		$rs = DB::table('users')->where('username',$res)->first();

		if($rs){
			echo 1;
		} else {
			echo 0;
		}
    }

    public function checkcode(Request $request)
    {
    	$options['accountsid']='9d02fb7b4380df420c9e0ffb546e4233';
		$options['token']='72922632437867cccdab3c63e33d4e01';
		$ucpass = new Ucpaas($options);
		// dump($ucpass);
		$appid = "73d75b8d6de84cfca582b0cd4b1a1973";
		$templateid = "410514";
		$code = rand(111111,999999);
		session(['code'=>$code]);
		$phone = $request->input('number');
		//可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
		$param = "$code,3"; //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
		$mobile = $phone;
		$uid = "";
		//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

		echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
    }

    //验证码验证
    public function checknum(Request $request)
	{
		$cd = $request->input('cv');
		$ce = session('code');
		var_dump($ce);
		//判断
		if($cd == $ce){
			echo 1;
		} else {
			echo 0;
		}
	}

	public function store(Request $request)
	{
        //获取表单传过来的信息 返回的数据是一个数组
        $rs = $request->except('_token','repassword','code');

        $rs['auth'] = 0;
        $rs['status'] = 1;
        $rs['addtime'] = time();
        //密码的加密
        $rs['password'] = Hash::make($request->password);
        //存放数据库里面
        $data = DB::table('users')->insert($rs);
        if($data){
        	return view('home.regist.success')->with([
	   				//跳转信息
	                'message'=>'注册成功，请登录',
	                //自己的跳转路径
	                'url' =>'/home/login',
	                //跳转路径名称
	                'urlname' =>'登录',
	                //跳转等待时间（s）
	                'jumpTime'=>3,
            ]);
        } else {
            return back();
        }
	}

	// 跳的登录页
	public function login()
	{
		return view('home.regist.login');
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
        $builder->build($width = 100, $height = 44, $font = null);
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

	public function dologin(Request $request)
	{
		$data = DB::table('users')->where('username',$request->username)->first();
		//验证用户名
		if (!$data) {
			return view('home.regist.success')->with([
   				//跳转信息
                'message'=>'用户名或密码错误',
                //自己的跳转路径
                'url' =>'/home/login',
                //跳转路径名称
                'urlname' =>'登录',
                //跳转等待时间（s）
                'jumpTime'=>3,
            ]);
		} else {
			//验证状态
			if ($data->status == 0){
				return view('home.regist.success')->with([
	   				//跳转信息
	                'message'=>'您的账号已被禁用,请联系客服',
	                //自己的跳转路径
	                'url' =>'/home/login',
	                //跳转路径名称
	                'urlname' =>'登录',
	                //跳转等待时间（s）
	                'jumpTime'=>3,
            	]);
			}	
			
			//验证密码
	    	$pass = $data->password;
	    	if(!Hash::check($request->password,$pass)){
				return view('home.regist.success')->with([
	   				//跳转信息
	                'message'=>'用户名或密码错误',
	                //自己的跳转路径
	                'url' =>'/home/login',
	                //跳转路径名称
	                'urlname' =>'登录',
	                //跳转等待时间（s）
	                'jumpTime'=>3,
            	]);
	    	}

	    	//验证码
	    	$code = session('code');
	    	if($code != $request->code){
	    		return view('home.regist.success')->with([
	   				//跳转信息
	                'message'=>'验证码错误',
	                //自己的跳转路径
	                'url' =>'/home/login',
	                //跳转路径名称
	                'urlname' =>'登录',
	                //跳转等待时间（s）
	                'jumpTime'=>3,
            	]);
	    	}

	    	//存储用户信息
	    	session(['uid'=>$data->id]);

	    	return redirect('/');
			}
		
	}

	public function logout()
    {
       	//清除session
      	session::forget('uid');

        //重定向
        return redirect('/');
    }
}
