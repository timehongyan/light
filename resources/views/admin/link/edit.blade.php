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
        	<form class="mws-form" action="/admin/link/{{$rs->id}}" method='post' enctype='multipart/form-data'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">链接名称</label>
        				<div class="mws-form-item">
        					<input type="text" name='fname' class="small" value='{{$rs->fname}}'>
        				</div>
        			</div>


        			<div class="mws-form-row">
        				<label class="mws-form-label">链接地址</label>
        				<div class="mws-form-item">
        					<input type="text" name='url' class="small" value='{{$rs->url}}'>
        				</div>
        			</div>

        		

        			<div class="mws-form-row">
                    	<label class="mws-form-label">头像</label>
                    	<div class="mws-form-item">
                            <img src="{{$rs->profile}}" alt="" style='width:120px'>
                        	<input type="file" name='profile' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                        </div>
                    </div>
        			
        			<div class="mws-form-row">
        				<label class="mws-form-label">状态</label>
        				<div class="mws-form-item clearfix">
        					<ul class="mws-form-list inline">
        						<li><label><input type="radio" name='status' value='1' @if($rs->status==1)checked @endif> 开启</label></li>
        						<li><label><input type="radio" name='status' value='0' @if($rs->status==0)checked @endif> 禁用</label></li>
        					</ul>
        				</div>
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

    },2000)
</script>

@stop
