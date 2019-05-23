<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Lunbo;
class LunboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $rs = Lunbo::orderBy('id','asc')->where(function($query) use($request){
                //检测关键字
               
                $url = $request->input('url');
            
                //如果地址不为空
                if(!empty($url)) {
                    $query->where('url','like','%'.$url.'%');
                }
            })->paginate($request->input('num', 2));


      

        return view('admin.lunbo.list',
            [
                'title'=>'轮播图页面',
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
         return view('admin.lunbo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            
            'url'=>'required'
              
        ],[                 
           'url.required'=>'链接地址不能为空', 
            ]);
        $rs = $request->except('_token');

        if($request->hasFile('url')){

            //获取图片上传的信息
            $file = $request->file('url');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['url'] = '/uploads/'.$name.'.'.$suffix;


        }
        //存放数据库
        $data = Lunbo::create($rs);
        //dd($data);
        if($data){
            return redirect('admin/lunbo');
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
    public function show($id)
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
        $rs = Lunbo::find($id);

        //显示页面
        return view('admin.lunbo.edit',[
            'title'=>'轮播图的修改页面',
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
        //验证
        $this->validate($request,[
            
            'url'=>'required'
        ],[                 
           'url.required'=>'链接地址不能为空', 
            ]);

        //删除头像
        $res = Lunbo::find($id);
        $data = @unlink('.'.$res->url);
        if(!$data){
            return back()->with('error','修改失败');
        }
      

     //修改数据
      $rs = $request->except('_token','_method');
     //判断是否有文件
     if($request->hasFile('url')){

            //获取图片上传的信息
            $file = $request->file('url');

            //名字
            $name = 'img_'.rand(1111,9999).time();

            //获取后缀
            $suffix = $file->getClientOriginalExtension();

            $file->move('./uploads',$name.'.'.$suffix);

            $rs['url'] = '/uploads/'.$name.'.'.$suffix;

        }
        $data = Lunbo::where('id',$id)->update($rs);
        if($data){
            return redirect('/admin/lunbo')->with('success','修改成功');
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
        $res = Lunbo::find($id);
        $data = @unlink('.'.$res->url);
        if(!$data){
            return back()->with('error','修改失败');
        }
        $data = Lunbo::destroy($id);
        if($data){
            return redirect('admin/lunbo')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
