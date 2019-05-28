@extends('common.admins')

@section('title','添加链接')


@section('content')
<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>添加友情链接</span>
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
        	<form class="mws-form" action="/admin/link" method='post' enctype='multipart/form-data'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">链接名称</label>
        				<div class="mws-form-item">
        					<input type="text" name='fname' class="small">
        				</div>
        			</div>

        			<div class="mws-form-row">
        				<label class="mws-form-label">链接地址</label>
        				<div class="mws-form-item">
        					<input type="text" name='url' class="small">
        				</div>
        			</div>

        			<div class="mws-form-row">
        				<label class="mws-form-label">添加链接头像</label>
        				<div class="mws-form-item" style="width:48%"	>
        					<input type="file" name='profile' class="small" >
        				</div>
        			</div>       			
        			<div class="mws-form-row">
        				<label class="mws-form-label">状态</label>
        				<div class="mws-form-item clearfix">
        					<ul class="mws-form-list inline">
        						<li><label><input type="radio" name='status' value='1' checked> 开启</label></li>
        						<li><label><input type="radio" name='status' value='0'> 禁用</label></li>
        					</ul>
        				</div>
        			</div>
        		</div>
        		<div class="mws-button-row">
        			{{csrf_field()}}
        			<input type="submit" value="添加" class="btn btn-primary">
        		</div>
        	</form>
        </div>    	
    </div>

@stop

@section('js')
<script>
	setInterval(function(){
		$('.mws-form-message').fadeOut(2000);
	},3000)
	

</script>
@stop

