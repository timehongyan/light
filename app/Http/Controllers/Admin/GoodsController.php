<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Goods;
use App\Http\Requests\GoodsRequest;
use App\Model\Admin\Type;
use App\Model\Admin\Goodspicture;
use DB;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $num = $request->num;
        $search = $request->search;
        // dd($search);
        $rs = Goods::where('gname', 'like', '%'.$search.'%')->orderBy('id', 'asc')->paginate($request->input('num', 10));
        return view('admin.goods.goodslist', ['title'=>'浏览商品', 'rs'=>$rs, 'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $rss = DB::select('select * from type order by CONCAT(path,id) asc');
        return view('admin.goods.goodscreate', ['title'=>'添加商品','rs'=>$rss]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoodsRequest $request)
    {
        $rs = $request->except('_token','gpic');
        $rs['addtime'] = time();
        $rs['num'] = 0;
        // dd($rs);
        $data = Goods::create($rs);
        // $gid = $data->id;
        // dd($gid);
        // 多文件上传
        if($request->hasFile('gpic')){
            $file = $request->file('gpic');
            $arr = [];
            // $gid = $data->id;
            // dd($gid);
            foreach($file as $k=>$v){
                $garr = [];
                // 图片的新名字
                $name = md5('img_'.rand(1111,9999).time());
                // 获取文件后缀
                $suffix = $v->getClientOriginalExtension();
                // 文件上传
                $v->move('./uploads/gimgs',$name.'.'.$suffix);
                $garr['gpic'] = '/uploads/gimgs/'.$name.'.'.$suffix;
                array_push($arr, $garr);
            }
        }

            //存储商品的图片
        $res = $data->gm()->createMany($arr);
            // dd($res);
        if ($res) {
            
            return redirect('/admin/goods')->with('success','添加成功');
        } else {
        
            return back()->with('error','添加失败');
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
        $goods = Goods::find($id);
        $gsrs = Goodspicture::where('gid',$id)->get();
        $gpic = [];
        foreach($gsrs as $k =>$v){
            $gpic[] = $v->gpic;
        }
        // dd($gpic);
        return view('admin.goods.goodsone', ['title'=>'商品详情','rs'=>$goods, 'gpic'=>$gpic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 分类
        $rs = DB::select('select * from type order by CONCAT(path,id) asc');
        // 商品详情的数据
        $val = Goods::find($id);
        // 关联表的数据
        $gs = $val->gm()->get();

        return view('admin.goods.goodsupdate', [
                'title'=>'修改商品信息',
                'rs'=>$rs,
                'val'=>$val,
                'gs'=>$gs
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GoodsRequest $request, $id)
    {
        $rs = $request->except('_token', 'gpic', '_method');
        $data = Goods::where('id',$id)->update($rs);
        // dd($rs);
        if($request->hasFile('gpic')){
            $file = $request->file('gpic');
            $aimg = [];
            foreach($file as $k=>$v){
                $garr = [];
                $garr['gid'] = $id;
                // 图片的新名字
                $name = md5('img_'.rand(1111,9999).time());
                // 获取文件后缀
                $suffix = $v->getClientOriginalExtension();
                // 文件上传
                $v->move('./uploads',$name.'.'.$suffix);
                $garr['gpic'] = '/uploads/'.$name.'.'.$suffix;

                array_push($aimg, $garr);
            }
        }
        // dd($aimg);
        $res = DB::table('goodspicture')->insert($aimg);
        if($res){
            return redirect('/admin/goods')->with('success','修改成功');
        } else {
            unlink('.'.$rs['gpic']);
            return redirect('/admin/goods')->with('success','修改失败');
        }
    }

    // ajax修改
    public function ajaxgs(Request $request)
    {
        // 获取ajax发送的数据
        $rs = $request->input('gname');
        $arr['gname'] = $rs;
        $id = $request->uid;
        // 修改
        $res = Goods::where('id', $id)->update($arr);
        if($res){
            $as = ['success'=>'修改成功', 'code'=>1];
            return response()->json($as);
        } else {
            return 0;
        }
    }

    // ajax删除图片
    public function ajaxdelete(Request $request)
    {
        // 获取ajax发送的数据
        $id = $request->id;
        // dump($id);
        $rs = Goodspicture::find($id);
        $data = unlink('.'.($rs->gpic));
        if(!$data){
            echo '删除图片路径失败';
        }
        $res = Goodspicture::where('id', $id)->delete();
        if($res){
            echo 1;
        } else {
            echo 0;
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
        // 获取信息 以备删除图片
        $rs = Goodspicture::where('gid', $id)->get();
        foreach($rs as $k => $v){
                unlink('.'.$v->gpic);
        }
        $gm = Goods::find($id);
        $gm->delete();

        $res = $gm->gm()->delete();
        if($res){
            
            return redirect('/admin/goods')->with('success', '删除成功');
        }else{
            return back();
        }
    }
}
