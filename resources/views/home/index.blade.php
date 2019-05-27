@extends('common.homes')

@section('title', $title)


@section('home')
    <!-- 定义分类菜单和banner图 start -->
        <div class="home_container con_width">
            <!-- 定义菜单 -->
            <div class="menu_list">
                <ul>
                    @php
                        $lefttype = 0;

                    @endphp
                    @foreach($leftrs as $tk=>$tv)
                    @php
                        if($lefttype > 9){
                            break;
                        }
                        $lefttype++;
                        if($tv->status == 0){
                            continue;
                        }
                    @endphp
                    <li><a href="#">{{$tv->tname}}<span class="arrow">&gt;</span></a>
                        <div class="menu_list_item">
                            <ul class="menu_list_goods menu_col_4">
                                @php
                                    $ledata = $goods->where('tid', $tv->id)->select()->take(24)->get();
                                @endphp
                                @foreach($ledata as $key=>$val)
                                @php
                                    if($val->status == 3){
                                        continue;
                                    }
                                    $legps = $goodspicture->where('gid', $val->id)->select('gpic')->first();
                                @endphp
                                <li>
                                    <a href="/home/details?id={{$val->id}}">
                                        <img src="{{$legps->gpic}}" alt="">
                                        <span>{{$val->gname}}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- 定义banner -->
            <div id="banner">
                <ul>
                    @php
                        $lbrs = $lunbo->orderBy('lgrade', 'desc')->get();
                        $lbnum = count($lbrs);
                    @endphp
                    @foreach($lbrs as $lbk=>$lbv)
                    <li class="active">
                        <a href="#"><img src="{{$lbv->url}}" alt="{{$lbv->id}}" title="小米"></a>
                    </li>
                    @endforeach
                </ul>
                <div id="circle-list">
                    <ul>
                        <li class="active-circle"></li>
                        @for($lbk=1; $lbk<$lbnum; $lbk++)
                        <li></li>
                        @endfor
                    </ul>
                </div>
                <div id="banner-left" class="banner-arrow">&lt;</div>
                <div id="banner-right" class="banner-arrow">&gt;</div>
            </div>
        </div>
        <!-- 定义分类菜单和banner图 end -->

        <!-- 定义推荐部分 start -->
        <div class="recommend con_width">
            <div class="recommend_left">
                <ul>
                    <li><a href="#"><i class="iconfont icon-shouji"></i><span>选购手机</span></a><div class="bottom_line"></div></li>
                    <li><a href="#"><i class="iconfont icon-lihe"></i><span>选购手机</span></a>
                        <div class="bottom_line"></div>
                    </li>
                    <li><a href="#"><i class="iconfont icon-Fma"></i><span>选购手机</span></a>
                    <div class="bottom_line"></div></li>
                </ul>
                <ul>
                    <li><a href="#"><i class="iconfont icon-shoujiqia"></i><span>选购手机</span></a></li>
                    <li><a href="#"><i class="iconfont icon-yijiuhuanxin"></i><span>选购手机</span></a></li>
                    <li><a href="#"><i class="iconfont icon-huafeichongzhi"></i><span>选购手机</span></a></li>
                </ul>
            </div>
            <div class="recommend_right">
                <ul>
                    <li><a href=""><img src="./home/images/img1.jpg" title="" alt=""/></a></li>
                    <li><a href=""><img src="./home/images/img2.jpg" title="" alt=""/></a></li>
                    <li><a href=""><img src="./home/images/img3.jpeg" title="" alt=""/></a></li>
                </ul>
            </div>
        </div>
        <!-- 定义推荐部分 end -->
        <!-- 小米闪购 start -->
        <div class="flashover con_width">
            <h1 class="list_title">小米闪购
                <div class="flashover_a">
                    <a href="javascript:;" onclick="flashover('R')">&lt;</a>
                    <a href="javascript:;" onclick="flashover('L')">&gt;</a>
                </div>
            </h1>
            <div class="flashover_list">
                <div class="flashover_item countdown goodlist4">
                    <p class="countdown_title">18:00 场</p>
                    <i class="iconfont icon-shandian"></i>
                    <p class="countdown_desc">距离结束还有</p>
                    <div class="countdown_time">
                        <label class="countdown_time_item" id="_h">00</label>
                        <label class="countdown_item_dot">:</label>
                        <label class="countdown_time_item" id="_m">00</label>
                        <label class="countdown_item_dot">:</label>
                        <label class="countdown_time_item" id="_s">00</label>
                    </div>
                </div>
                <div class="flashover_item_con" id="shangou">
                    <div class="flashover_item_con_div" id="shangouCon" style="left: 0px">
                        <div class="flashover_item flashover_goodlist goodlist1">
                            <a href="#" alt="米兔指尖积木 白色" title="米兔指尖积木 白色">
                                <div class="goodlist_content">
                                    <img src="./home/images/good1.png" alt="">
                                    <p class="good_title">米兔指尖积木 白色</p>
                                    <p class="good_desc">玩转你的自由时光</p>
                                    <p class="good_price">1 元 <label>9.9元</label></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 小米闪购 end -->
        
        <!-- 广告 start -->
        <div class="ad_container con_width">
            <a href="#" alt="小米8 6G+128G" title="小米8 6G+128G"><img src="./home/images/xmad_15326189127178_tugca.jpg"></a>
        </div>
        <!-- 广告 end -->
        
        <!-- 产品列表 start -->
        <div class="goods">
            <!-- 手机 start -->
            <div class="flashover con_width clearfix">
                @php
                    $congoods = $type->getfenleiMessage(28);
                    $cgarr = [];
                    $i = 0;
                    foreach($congoods as $cgk=>$cgv){
                        if($cgv->status != 0){
                            $cgarr[$i]['id'] = $cgv->id;
                            $cgarr[$i]['tname'] = $cgv->tname;
                            $i++;
                        }
                    }
                    $i = 0;
                    $congoods =  $goods->where('tid', $cgarr[$i]['id'])->select()->take(8)->get(); 
                @endphp
                <h1 class="list_title">{{$cgarr[$i++]['tname']}}<a href="">查看更多<i class="iconfont icon-xiangyoujiantou"></i></a></h1>
                <div class="goods_item_left1">
                    <a href="#"><img src="./home/images/xmad_15323220713837_GLBVX.jpg"/></a>
                </div>
                @foreach($congoods as $ck=>$cv)
                @php
                    if($cv->status == 3){
                        continue;
                    }
                    $legps = $goodspicture->where('gid', $cv->id)->select('gpic')->first();
                @endphp
                <div class="goods_item_right">
                    <div class="goods_item_list">
                        <div class="goodlist_content">
                            <a href="/home/details?id={{$cv->id}}"><img src="{{$legps->gpic}}" alt=""></a>
                            <p class="good_title"><a href="/home/details?id={{$cv->id}}">{{$cv->gname}}</a></p>
                            <p class="good_desc">AI 超感光双摄，三星 AMOLED 屏幕</p>
                            <p class="good_price">{{$cv->price}}元</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- 手机 end -->
        
            <!-- 广告 start -->
            <div class="ad_container con_width">
                <a href="#" alt="小米电视" title="小米电视"><img src="./home/images/xmad_15329210161578_SWgUX.jpg"></a>
            </div>
            <!-- 广告 end -->

            <!-- 家电 start -->
            @php
                $congoods =  $goods->where('tid', $cgarr[$i]['id'])->select()->take(7)->get();
            @endphp
            <div class="wiring con_width clearfix">
                <h1 class="list_title" id="houseElectricalTitle">{{$cgarr[$i++]['tname']}}
                    <ul>
                        <li class="active"><a href="#">热门</a></li>
                    </ul>
                </h1>
                <div class="wiring_left">
                    <a href="#"><img src="./home/images/xmad_15232550390498_qwxEC.jpg"/></a>
                    <a href="#"><img src="./home/images/xmad_15232550390498_qwxEC.jpg"/></a>
                </div>
                <div class="wiring_right" id="houseElectricalDiv">
                    <!-- 热门 -->
                    <div class="wiring_right_con">
                        @foreach($congoods as $ck=>$cv)
                        @php
                            if($cv->status == 3){
                                continue;
                            }
                            $legps = $goodspicture->where('gid', $cv->id)->select('gpic')->first();
                        @endphp
                        <div class="goods_item_list">
                            <div class="goodlist_content">
                                <label>{{status($cv->status)}}</label>
                                <a href="/home/details?id={{$cv->id}}"><img src="{{$legps->gpic}}" alt=""></a>
                                <p class="good_title"><a href="/home/details?id={{$cv->id}}">{{$cv->tname}}</a></p>
                                <p class="good_desc">4K超高清屏 / 真四核64位高性能处理器</p>
                                <p class="good_price">{{$cv->price}}元<label>4499元</label></p>
                            </div>
                            <div class="goods_item_list_desc">
                                <p class="goods_item_list_desc_con">小米电视给我惊喜，昨天下午下单，第二天上午就送到家啦...</p>
                                <span> 来自于 陈金壮 的评价</span>
                            </div>
                        </div>
                        @endforeach
                        <div class="goods_item_list_last">
                            <div class="goods_item_last_list clearfix">
                                <div class="goods_item_last_list_left">
                                    <a href="#">小米盒子3s</a>
                                    <span>299元</span>
                                </div>
                                <div class="goods_item_last_list_right">
                                    <img src="./home/images/pms_1479190789.95594557!220x220.jpg" />
                                </div>
                            </div>
                            <div class="goods_item_last_list clearfix">
                                <div class="goods_item_last_list_left">
                                    <a href="#" class="more">
                                        <p>浏览更多</p>
                                        <label>热门</label>
                                    </a>
                                </div>
                                <div class="goods_item_last_list_right">
                                    <a href="#"><i class="iconfont icon-you"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 家电 end -->

            <!-- 广告 start -->
            <div class="ad_container con_width">
                <a href="#" alt="小米电视" title="小米电视"><img src="./home/images/xmad_15330597618059_zrRgh.jpg"></a>
            </div>
            <!-- 广告 end -->

            <!-- 智能 start -->
            @php
                $congoods =  $goods->where('tid', $cgarr[$i]['id'])->select()->take(7)->get();
            @endphp
            <div class="wiring con_width clearfix">
                <h1 class="list_title">{{$cgarr[$i++]['tname']}}
                    <ul>
                        <li class="active"><a href="#">热门</a></li>
                        <li><a href="#">出行</a></li>
                        <li><a href="#">健康</a></li>
                        <li><a href="#">酷玩</a></li>
                        <li><a href="#">路由器</a></li>
                    </ul>
                </h1>
                <div class="wiring_left">
                    <a href="#"><img src="./home/images/xmad_15266395374048_JnZQo.jpg"/></a>
                    <a href="#"><img src="./home/images/xmad_15266395374048_JnZQo.jpg"/></a>
                </div>
                <div class="wiring_right">
                    @foreach($congoods as $ck=>$cv)
                        @php
                            if($cv->status == 3){
                                continue;
                            }
                            $legps = $goodspicture->where('gid', $cv->id)->select('gpic')->first();
                        @endphp
                    <div class="goods_item_list">
                        <div class="goodlist_content">
                            <a href="/home/details?id={{$cv->id}}"><img src="{{$legps->gpic}}" alt=""></a>
                            <p class="good_title"><a href="/home/details?id={{$cv->id}}">{{$cv->tname}}</a></p>
                            <p class="good_desc">感知环境光，主动优化场景照明</p>
                            <p class="good_price">{{$cv->price}}元</p>
                        </div>
                        <div class="goods_item_list_desc">
                            <p class="goods_item_list_desc_con">一流的服务、一流的设备、一流的技术、一流的设施、星级...</p>
                            <span>来自于 上网辛苦了 的评价 </span>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="goods_item_list_last">
                        <div class="goods_item_last_list clearfix">
                            <div class="goods_item_last_list_left">
                                <a href="#">小米VR眼镜</a>
                                <span>299元</span>
                            </div>
                            <div class="goods_item_last_list_right">
                                <img src="./home/images/pms_1477985364.89714934!220x220.jpg" />
                            </div>
                        </div>
                        <div class="goods_item_last_list clearfix">
                            <div class="goods_item_last_list_left">
                                <a href="#" class="more">
                                    <p>浏览更多</p>
                                    <label>热门</label>
                                </a>
                            </div>
                            <div class="goods_item_last_list_right">
                                <a href="#"><i class="iconfont icon-you"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 智能 end -->

            <!-- 广告 start -->
            <div class="ad_container con_width">
                <a href="#" alt="小米电视" title="小米电视"><img src="./home/images/xmad_15330597618059_zrRgh.jpg"></a>
            </div>
            <!-- 广告 end -->

            <!-- 为你推荐 start -->
            @php
                $congoods =  $goods->where('tid', $cgarr[$i]['id'])->select()->take(7)->get();
            @endphp
            <div class="recommends con_width clearfix">
                <h1 class="list_title">{{$cgarr[$i++]['tname']}}</h1>
                <div class="recommends_con">
                    @foreach($congoods as $ck=>$cv)
                    @php
                        if($cv->status == 3){
                            continue;
                        }
                        $legps = $goodspicture->where('gid', $cv->id)->select('gpic')->first();
                    @endphp
                    <div class="goods_item_list">
                        <div class="goodlist_content">
                            <a href="/home/details?id={{$cv->id}}"><img src="{{$legps->gpic}}" alt=""></a>
                            <p class="good_title"><a href="/home/details?id={{$cv->id}}"> {{$cv->tname}} </a></p>
                            <p class="good_price">{{$cv->price}}元</p>
                            <p class="good_desc">96人好评</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- 为你推荐 end -->
            
            <!-- 热评产品 start -->
            @php
                $congoods =  $goods->where('tid', $cgarr[$i]['id'])->select()->take(7)->get();
            @endphp
            <div class="hotreview con_width clearfix">
                <h1 class="list_title">{{$cgarr[$i++]['tname']}}</h1>
                <div class="hotreview_con">
                    @foreach($congoods as $ck=>$cv)
                    @php
                        if($cv->status == 3){
                            continue;
                        }
                        $legps = $goodspicture->where('gid', $cv->id)->select('gpic')->first();
                    @endphp
                    <div class="hotreview_item">
                        <a class="hotreview_img" href="/home/details?id={{$cv->id}}"><img src="{{$legps->gpic}}"/></a>
                        <a href="/home/details?id={{$cv->id}}" class="hotreview_desc">
                            包装很让人感动，式样也很可爱，做出的饭全家人都爱吃，超爱五星！手机控制还是不太熟练，最主要是没有连接...
                        </a>
                        <p><a class="hotreview_recommend">来自于 HZG 的评价</a></p>
                        <p class="hotreview_intro">
                        <label class="hotreview_name">{{$cv->gname}}</label>
                        <label class="hotreview_name_line">&nbsp;</label>
                        <label class="hotreview_price">{{$cv->price}}元</label>
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- 热评产品 end -->

        </div>
        <!-- 产品列表 end -->
@stop

@section('hjs')

@stop