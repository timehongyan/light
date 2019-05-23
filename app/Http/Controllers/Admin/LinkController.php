<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Link;
class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rs = Link::orderBy('id','asc')->where(function($query) use($request){
                //检测关键字
                $username = $request->input('fname');
                $url = $request->input('url');
                //如果用户名不为空
                if(!empty($fname)) {
                    $query->where('fname','like','%'.$fname.'%');
                }
                //如果地址不为空
                if(!empty($url)) {
                    $query->where('url','like','%'.$url.'%');
                }
            })->paginate($request->input('num', 4));


      

        return view('admin.link.list',
            [
                'title'=>'链接页面',
                'rs'=>$rs,
                'request'=>$request
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.link.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $this->validate($request,[
            'fname'=>'required',
            'url'=>'required',
            'profile'=>'required',
              
        ],[
                'fname.required'=>'链接名不能为空',
                'profile.required'=>'链接名不能为空',
                'url.required'=>'链接地址不能为空',
                
            ]);
        $rs = $request->except('_token');
        //dd($rs);
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
        // dd($rs);
        //存放数据库
        $data = Link::create($rs);
        //dd($data);
        if($data){
            return redirect('admin/link');
        }else{
            return back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //
        
       
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //根据id获取数据
        $rs = Link::find($id);

        //显示页面
        return view('admin.link.edit',[
            'title'=>'链接的修改页面',
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
    public function update(Request $request, $id)
    {
        //表单验证
        $this->validate($request,[
            'fname'=>'required',
            'url'=>'required',
            'profile'=>'required',
              
        ],[
                'fname.required'=>'链接名不能为空', 
                'url.required'=>'链接地址不能为空',
                'profile.required'=>'链接图片不能为空',
                
            ]);
        //删除头像
        $res = Link::find($id);
      
            $data = @unlink('.'.$res->profile);

            if(!$data){
            return back()->with('error','修改失败');
            }
        
       
         //获取数据
        $rs = $request->except('_token','_method');
        //dd($rs);
        //处理头像
        if($request->hasFile('profile')){

            //获取图片上传的信息
            $file = $request->file('profile');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['profile'] = '/uploads/'.$name.'.'.$suffix;


        }


        //修改数据
        $data = Link::where('id',$id)->update($rs);

        if($data){

            return redirect('/admin/link')->with('success','修改成功');
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
        //
        //删除头像
        $res = Link::find($id);
        $data = @unlink('.'.$res->profile);
        if(!$data){
            return back()->with('error','删除失败');
        }
        $data = Link::destroy($id);
        if($data){
            return redirect('admin/link')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
