@extends('common.admins')

@section('title','添加链接')


@section('content')
<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>添加轮播图</span>
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
        	<form class="mws-form" action="/admin/lunbo" method='post' enctype='multipart/form-data'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">图片链接地址</label>
        				<div class="mws-form-item" style='width:200px'>
        					<input type="file" name='url' class="small" >
        				</div>
        			</div>

        			       			
        			<div class="mws-form-row">
        				<label class="mws-form-label">轮播图等级</label>
        				<div class="mws-form-item clearfix">
        					<ul class="mws-form-list inline">
        						<li><label><input type="radio" name='lgrade' value='0' checked>初级</label></li>
                                <li><label><input type="radio" name='lgrade' value='1'> 中级</label></li>
        						<li><label><input type="radio" name='lgrade' value='2'> 高级</label></li>
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

