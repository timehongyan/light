<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\FormsRequest;
use App\Http\Requests\FormuRequest;
use App\Model\Admin\message;
use App\Model\Admin\User;
use DB;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //获取传过来的信息
        // $um = $_GET['num'];
        // $se= $_GET['search'];
        // dump($um,$se);
        // echo "asdf";
        // $num = $request->num;
        // $search = $request->search;
        
        //单个条件搜索
         $rs = User::orderBy('id','asc')
        ->where(function($query) use($request){
            //检测关键字
            $username = $request->input('username');
            $email = $request->input('phone');
            //如果用户名不为空
            if(!empty($username)) {
                $query->where('username','like','%'.$username.'%');
            }
            //如果邮箱不为空
            if(!empty($email)) {
                $query->where('phone','like','%'.$email.'%');
            }
        })
        ->paginate($request->input('num', 10));
        //获取数据
        // $rs = User::where('username','like','%'.$search.'%')->paginate($request->input('num',10));

        // 多个条件的搜索
        
        //显示一个列表页
        return view('admin/user/list',['title'=>'用户列表页面','rs'=>$rs,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       return view('admin/user/create',['title'=>'用户添加页面']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormsRequest $request)
    {
        // 表单验证
       /* $this->validate($request, [
             'username' => 'required|regex:/^\w{6,12}$/',
            'password' => 'required|regex:/^\S{8,16}$/',
            'repass'=>'same:password',
            'phone'=>'required|regex:/^1[3456789]\d{9}$/'
            // 'body' => 'required',
        ],[
            'username.required' => '用户名不能为空',
            'username.regex' => '用户名格式不正确',
            'username.unique' => '用户名已经存在',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码格式不正确',
            // 'repass.required'=>'确认密码不能为空',
            'repass.same'=>'两次密码不一致',
            'phone.required'=>'手机号码不能为空',
            'phone.regex'=>'手机号码格式不正确',
        ]);*/
        //获取表单传过来的信息 返回的数据是一个数组
       
        $rs = $request->except('_token','repass','profile');



        $rs['addtime'] = time();
        //密码的加密
        $rs['password'] = Hash::make($request->password);
        // dump($rs);die; 
        //存放数据库里面
        $data = User::insertGetId($rs); 
        // session(['id' => $data]);
        if($data > 0){

            return redirect('admins/user');

        } else {

            return back();

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          //根据id获取数据
        $rs = User::find($id);

        //显示页面
        return view('admin.user.edit',[
            'title'=>'用户的修改页面',
            'rs'=>$rs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormuRequest $request, $id)
    {
       


        //获取数据
        $rs = $request->except('_token','_method');
        //修改数据
        $data = User::where('id',$id)->update($rs);


        if($data > 0){

            return redirect('/admins/user')->with('success','修改成功');
        } else {

            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

         $rs =  DB::table('users')
        ->join('message','users.id','=','message.uid')
        
        ->select('users.*','message.header')
        ->where('users.id','=',$id)
        ->first();
        if($rs){
            $res = Message::where('uid',$id)->first();
            unlink('.'.$res->header);
            $data = Message::where('uid',$id)->delete();
        } else {
            $data = User::destroy($id);
        }
        //
        //根据id删除数据
        

        if($data){

            return redirect('/admins/user')->with('success','删除成功');
        } else {

            return back()->with('error','删除失败');

        }
        
    }
}
