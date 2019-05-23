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
        	<form class="mws-form" action="/admin/lunbo/{{$rs->id}}" method='post' enctype='multipart/form-data'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">图片链接地址</label>
        				<div class="mws-form-item" style='width:200px'>
        					
                            <img src="{{$rs->url}}" alt="" style='width:120px'>
                            <input type="file" name='url' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
        				</div>
        			</div>
        			
        			<div class="mws-form-row">
        				<label class="mws-form-label">轮播图等级</label>
        				<div class="mws-form-item clearfix">
        					<ul class="mws-form-list inline">
        						<li><label><input type="radio" name='lgrade' value='0' @if($rs->lgrade==0)checked @endif> 初级</label></li>
                                <li><label><input type="radio" name='lgrade' value='1' @if($rs->lgrade==1)checked @endif> 中级</label></li>
        						<li><label><input type="radio" name='lgrade' value='2' @if($rs->lgrade==2)checked @endif> 高级</label></li>
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
