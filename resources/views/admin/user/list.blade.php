@extends('common/admins')


@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            {{$title}}
        </span>
    </div>
    
    @if(session('success'))
    <div class="mws-form-message info">
        {{session('success')}}
    </div>
    @endif
    

    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
			
			<form action="/admins/user" method='get'>
	            <div id="DataTables_Table_1_length" class="dataTables_length">
	                <label>
	                    显示
	                    <select size="1" name="num" aria-controls="DataTables_Table_1">
	                        <option value="10"  @if($request->num == '10') selected="selected" @endif>
	                            10
	                        </option>
	                        <option value="20" @if($request->num == '20') selected="selected" @endif>
	                            20
	                        </option>
	                        <option value="30" @if($request->num == '30') selected="selected" @endif>
	                            30
	                        </option>
	                        
	                    </select>
	                    条数据
	                </label>
	            </div>
	           
                <div class="dataTables_filter" id="DataTables_Table_1_filter">
	            	 <label>
                        手机号:
                        <input type="text" name='phone' aria-controls="DataTables_Table_1" value="{{$request->phone}}">
                    </label>
	                <label>
	                    用户名:
	                    <input type="text" name='username' aria-controls="DataTables_Table_1" value="{{$request->username}}">
	                </label>

	                <button class='btn btn-info'>搜索</button>
	            </div>
            </form>



            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row" style="">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 20px;">
                            ID
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 190px;">
                            用户名
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 90px;">
                            权限
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 210px;">
                            手机号
                        </th>
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 230px;">
                            注册时间
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 50px;">
                           状态
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 50px;">
                           头像
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width:145px;">
                           操作
                        </th>
                    </tr>
                </thead>

                <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($rs as $k => $v)
                	@if($k % 2 == 0)
 						<tr class="odd" style="text-align: center">
                	@else
 						<tr class="even" style="text-align: center">
						
                	@endif
                  
                        <td class="">
                            {{$v->id}}
                        </td>
                        <td class=" ">
                            {{$v->username}}
                        </td>
                        <td class=" ">
                           @switch($v->auth)
                                @case(1)
                                    VIP会员
                                    @break

                                @case(2)
                                    超级管理员
                                    @break

                                @default
                                    普通用户
                            @endswitch


                        </td>
                        <td class=" ">
                            {{$v->phone}}
                            
                        </td>                        
                        <td class=" ">
                            @php echo date('Y-m-d H:i:s',$v->addtime)@endphp
                            
                        </td>
                        <!-- <td class=" ">
                            
                            <img src="" alt="" style='width:80px'>
                        </td> -->
                        <td  class="ztai">
                            @if($v->status == 1)
                                <a  href="#" title="已启用" style="color:">已启用</a>
                            @else
                                <a  href="#" title="已禁用" style="color:">已禁用</a>
                            @endif

                            {{--$v->status ? '开启' : '禁用'--}}

                        </td>
                         @php
                                $res =  DB::table('users')
                                ->join('message','users.id','=','message.uid')
                                
                                ->select('users.*','message.header')
                                ->where('users.id','=',$v->id)
                                ->first();
                                
                            @endphp
                         <td class=" ">
                            @if($res)

                            <a href="/admins/users/header/{{$v->id}}"><img src="{{$res->header}}" style="width:50px;height: 33px"></a>
                            @else
                            <a href="/admins/user/info/{{$v->id}}"><img src="/default.jpg"  style="width:50;height: 33px"></a>
                            @endif
                        </td>
                        <td class=" ">
                            <span class="btn-group">
                                 <a class="btn btn-small" title="用户权限"  href="/admins/userrole?id={{$v->id}}"><i class="icon-key-2"></i></a>

                                @if($res)
                                    <a class="btn btn-small"  title="用户详情" href="/admins/user/edit/{{$v->id}}"><i   class="icon-search"></i></a>
                                @else

                                    <a class="btn btn-small" title="添加详情" href="/admins/user/info/{{$v->id}}"><i class="icon-add-contact"></i></a>
                                @endif

                                <a class="btn btn-small"  title="修改用户" href="/admins/user/{{$v->id}}/edit"><i class="icon-pencil"></i></a>

                                <form action="/admins/user/{{$v->id}}" method='post' style='display: inline'>
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-small" title="删除用户"><i   class="icon-trash"></i></button>
                                </form>

                            </span>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
			
			<style>
				.pagination{

					margin:0px;
				}

				.pagination li{
					    float: left;
					    height: 20px;
					    padding: 0 10px;
					    display: block;
					    font-size: 12px;
					    line-height: 20px;
					    text-align: center;
					    cursor: pointer;
					    outline: none;
					    background-color: #444444;
					   
					    text-decoration: none;
					    border-right: 1px solid rgba(0, 0, 0, 0.5);
					    border-left: 1px solid rgba(255, 255, 255, 0.15);
					    box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.15);
				}

				.pagination a{
					 color: #fff;
				}

				.pagination .active{
					
					color: #323232;
				    border: none;
				    background-image: none;
				    box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.25);
				    background-color: #f08dcc;
				}

			</style>

            <div class="dataTables_info" id="DataTables_Table_1_info">
                显示 {{$rs->firstItem()}} ~ {{$rs->lastItem()}} of {{$rs->count()}} 条数据  总共是{{$rs->total()}}条数据
                <!-- 每页显示几条数据 -->
                {{--$rs->count()--}}
                <!-- 显示当前的页码 -->
                {{--$rs->currentPage()--}}
                <!-- 显示当前页的数据从哪开始 -->
                {{--$rs->firstItem()--}}
                <!-- 返回的是boolean -->
                {{--$rs->hasMorePages()--}}
                <!-- 显示当前页的数据结束 -->
                {{--$rs->lastItem()--}}
                <!-- 显示的最后的页码 -->
                {{--$rs->lastPage()--}}
                <!-- 显示的是下一页的url地址 http://myapp.cn/admin/user?page=2 -->
                {{--$rs->nextPageUrl()--}}
                <!-- 显示的是每页的数据有多少条 -->
                {{--$rs->perPage()--}}
                <!-- 显示的是上一页的url地址 http://myapp.cn/admin/user?page=1 -->
                {{--$rs->previousPageUrl()--}}
                
                <!-- 显示的总条数 -->
                {{--$rs->total()--}}
                
                <!-- 根据参数获取分页的url地址 -->
                {{--$rs->url(4)--}}
            </div>
            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
				{{$rs->appends([ $request -> all()])->links()}}
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
  <script>
    //文档加载
    $(function () {
        $("#file_upload").change(function () {
                //  判断是否有选择上传文件
                var imgPath = $("#file_upload").val();

                if (imgPath == "") {
                    alert("请选择上传图片！");
                    return;
                }
                //判断上传文件的后缀名
                var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                if (strExtension != 'jpg' && strExtension != 'gif' && strExtension != 'jpeg'
                    && strExtension != 'png') {
                    alert("请选择图片文件");
                    return;
                }

                var formData = new FormData($('#art_form')[0]);
                $.ajax({
                    type: "POST",
                    url: "/admins/upload",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#imgs').attr('src',data);

                        location.href ='/admins';
                    },

                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("上传失败，请检查网络后重试");
                    }
                });
        })
    })
    var ztai = $('.ztai').click(function (){
        var id =$(this).parents('tr').find('td').eq(0).html().trim();
        var jin = $(this).find('a');


        if(jin.attr('title') == '已启用'){
            $.get('/admins/ajaxs',{sta : 0,id:id},function (data){
                console.log(data);
            });
            jin.attr('title','已禁用');

            jin.html('已禁用');
            jin.css('color:red');
        } else {
            $.get('/admins/ajaxs',{sta : 1,id:id},function (data){
                console.log(data);
            });
            jin.attr('title','已启用');
            jin.html('已启用');
            
        }
    });
      //禁用启用
      // var ztai = $('#ztai');
      // ztai.click(function (){
        
      //       var id =$(this).parents('tr').find('td').eq(1).html();
      //       console.log(id);
      // });



    setTimeout(function(){

        $('.mws-form-message').hide(1200)
    },2000)  
  </script>
 


@stop