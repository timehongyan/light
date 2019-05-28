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
        	<form class="mws-form" action="/admins/users/infoupdate" method='post' enctype='multipart/form-data'>
        		<div class="mws-form-inline">
                    <input type="hidden" name="uid" value="{{$uid}}">
        			<div class="mws-form-row">
        				<label class="mws-form-label">昵称</label>
        				<div class="mws-form-item">
        					<input type="text" name='mname' class="small" value="{{$rs->mname}}">
        				</div>
        			</div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">性别</label>
                        <div class="mws-form-item" style="width:275px">
                            <select class="large" name="sex">
                                <option value="0" @if($rs->sex==1)selected @endif>女</option>
                                <option value="1" @if($rs->sex == 1)selected @endif>男</option>
                                <option value="2" @if($rs->sex == 2)selected @endif>保密</option>
                            </select>
                        </div>
                    </div>


        			<div class="mws-form-row">
                        <label class="mws-form-label">地址</label>
                        <div class="mws-form-item">
                            <input type="text" name='address' class="small" value="{{$rs->address}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
        				<label class="mws-form-label">邮箱</label>
        				<div class="mws-form-item">
        					<input type="text" name='email' class="small" value="{{$rs->email}}">
        				</div>
        			</div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">头像</label>
                        <div class="mws-form-item">
                            <img src="{{$rs->header}}" style="width:190px">
                            <input type="file" name='header' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                        </div>
                    </div>	
        		</div>
        		<div class="mws-button-row">
        			{{csrf_field()}}
                    <input type="submit" value="修改" class="btn btn-primary">


        		</div>
        	</form>
        </div>    	
    </div>
@stop

@section('js')

<script>
    //让错误的信息3秒钟之后消失
    /*setInterval(function(){


    },3000)*/

    setTimeout(function(){
        // $('.mws-form-message').slideUp(2000);
        $('.mws-form-message').fadeOut(2000);

    },3000)

    // delay(3000).

    
</script>

@stop