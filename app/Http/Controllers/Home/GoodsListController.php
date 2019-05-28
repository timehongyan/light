<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Goods;
use DB;

class GoodsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gname = $request->search;

        $rs = DB::table('goods')
        ->join('goodspicture','goods.id','=','goodspicture.gid')
        ->where('goods.gname','like','%'.$gname.'%')
        ->select('goods.*','goodspicture.gpic')
        ->get();
        $arr = [];
        foreach($rs as $k => $v){
            $arr[] = DB::table('type')->where('id',$v->tid)->get();
            // $rs[$k] = DB::table('goodspicture')->where('gid',$v->id)->first();
            
        }

       $narr =  array_unique($arr);

        return view('home/goods/list',['rs'=>$rs,'arr'=>$narr,'gname'=>$gname]);
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
        //
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
    }
}
