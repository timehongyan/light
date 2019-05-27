@extends('common/admins')

@section('title',$title)

@section('content')
	<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>{{$title}}</span>
        </div>

        @if (count($errors) > 0)
		    <div class="mws-form-message error">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		<div class="mws-panel-body no-padding">
        	<form class="mws-form" action="/admins/poster/{{$rs->id}}" method='post' enctype='multipart/form-data'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">广告商家</label>
        				<div class="mws-form-item">
        					<input type="text" name='postername' class="small" value="{{$rs->postername}}">
        				</div>
        			</div>

        			<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">广告图像</label>
        				<div class="mws-form-item">
        					<img src="{{$rs->url}}" alt="" style='width:120px'>
        				</div>
        			</div>

        			

        			<div class="mws-form-row">
                    	<label class="mws-form-label">修改广告图像</label>
                    	<div class="mws-form-item" style="width: 60%;">
                    		 
                        	<input type="file" name='url' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">广告类别</label>
                            <div class="mws-form-item clearfix">
                                <ul class="mws-form-list inline">
                                    <li><label><input type="radio" name='type' value='0' @if($rs->type==0)checked @endif> 首页广告</label></li>
                                    <li><label><input type="radio" name='type' value='1' @if($rs->type==1)checked @endif> 商品搜索广告</label></li>
                                    <li><label><input type="radio" name='type' value='2' @if($rs->type==2)checked @endif> 商品列表广告</label></li>
                                    <li><label><input type="radio" name='type' value='3' @if($rs->type==3)checked @endif> 详情页广告</label></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mws-form-row">
        				<label class="mws-form-label">广告状态</label>
	        				<div class="mws-form-item clearfix">
	        					<ul class="mws-form-list inline">
	        						<li><label><input type="radio" name='pograde' value='0' @if($rs->pograde==0)checked @endif> 普通广告</label></li>
	        						<li><label><input type="radio" name='pograde' value='1' @if($rs->pograde==1)checked @endif> 失效广告</label></li>
	        						<li><label><input type="radio" name='pograde' value='2' @if($rs->pograde==2)checked @endif> 置顶广告</label></li>
	        					</ul>
	        				</div>
	        			</div>
	        		</div>

                    <div class="mws-form-row">
                    	<label class="mws-form-label" style="width: 157px;float: left;">广告内容 </label>
		                    <div class="mws-form-item">
		                        <textarea name="content" rows="" cols="" class="required large" style="width: 70%;">{{$rs->content}}</textarea>
		                    </div>
                	</div>


					
        		<div class="mws-button-row">
        			{{csrf_field()}}

                    {{method_field('PUT')}}
        			<input type="submit" value="修改" class="btn btn-primary">
        		</div>
        	</form>
        </div>    	
    </div>
@stop

@section('js')

<script>
    setTimeout(function(){
        $('.mws-form-message').fadeOut(2000);

    },3000)
</script>

@stop