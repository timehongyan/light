@extends('common/admins')

@section('title',$title)


@section('content')
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
						<form action="/admin/link" method='get'>
	            <div id="DataTables_Table_1_length" class="dataTables_length">
	                <label>
	                    显示
	                    <select size="1" name="num" aria-controls="DataTables_Table_1">
	                        <option value="5" @if($request->num == '5') selected="selected" @endif >
	                            5
	                        </option>
	                        <option value="10" @if($request->num == '10') selected="selected" @endif>
	                            10
	                        </option>
	                        <option value="15" @if($request->num == '15') selected="selected" @endif>
	                            15
	                        </option>
	                        
	                    </select>
	                    条数据
	                </label>
	            </div>
	            <div class="dataTables_filter" id="DataTables_Table_1_filter">
	            	<label>
	                    用户名:
	                    <input type="text" name='fname' aria-controls="DataTables_Table_1" value="{{$request->fname}}">
	                </label>
	                <label>
	                    地址:
	                    <input type="text" name='url' aria-controls="DataTables_Table_1" value="{{$request->url}}">
	                </label>

	                <button class='btn btn-info'>搜索</button>
	            </div>
            </form>




            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 20px;">
                            ID
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 90px;">
                            链接名称
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 90px;">
                            链接地址
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 97px;">
                           添加时间
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 97px;">
                           链接头像
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 50px;">
                           状态
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 97px;">
                           操作
                        </th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                @foreach($rs as $k => $v)
                	@if($k % 2 == 0)
 						<tr class="odd">
                	@else
 						<tr class="even">
						
                	@endif
                  
                        <td class="">
                            {{$v->id}}
                        </td>
                        <td class=" ">
                            {{$v->fname}}
                        </td>
                        <td class=" ">
                            {{$v->url}}
                            
                        </td>
                        <td class=" ">
                            {{date('Y-m-d H:i:s',$v->addtime)}}
                            
                        </td>
                        
                        <td class=" ">
                            <img src="{{$v->profile}}" alt="" style='width:80px'>
                        </td>

                        <td class=" ">
                           
                            @if($v->status == 1)
                                开启
                            @else
                                禁用
                            @endif
                            

                            
                        </td>
                        <td class=" ">
                            
                            <a class='btn btn-warning' href="/admin/link/{{$v->id}}/edit">修改</a>


                            <form action="/admin/link/{{$v->id}}" method='post' style='display: inline'>
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class='btn btn-danger'>删除</button>
                            </form>
                        </td>	
                    </tr>
                    @endforeach

                </tbody>
            </table>
			


	
  <div class="dataTables_info" id="DataTables_Table_1_info">
                显示 {{$rs->firstItem()}} 到 {{$rs->lastItem()}} 当前 {{$rs->count()}} 条数据  总共是{{$rs->total()}}条数据

            </div>
  
            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
				{{$rs->appends($request->all())->links()}}
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
  <script>
      
    setTimeout(function(){

        $('.mws-form-message').hide(1200)
    },2000)  
  </script>
 



@stop