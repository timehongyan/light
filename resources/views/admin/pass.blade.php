@extends('common.admins')

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
            @if(session('error'))
                <div class="mws-form-message warning">
                     {{session('error')}}
                </div>
            @endif
        <div class="mws-panel-body no-padding">
        	<form class="mws-form" action="/admin/dopass" method='post' >
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
                        <label class="mws-form-label">旧密码</label>
                        <div class="mws-form-item">
                                <span>
                                  <input name='oldpass'   type="password" class="small mima_dd " placeholder="请输入旧密码" >
                                  <input name='oldpass'  type="text" class="small mima_wz" style="display:none;" placeholder="请输入旧密码" >
                                  <a class="eyes_box " data-show="1" href="javascript:void(0);"><i style="margin-left:10px" class="icon-eye-open"></i></a> </span>
                        </div>

                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">请输入新密码</label>
                        <div class="mws-form-item">
                                <span>
                                  <input name='password'  type="password" class="small mima_dd " placeholder="请输入新密码" >
                                  <input name='password' type="text" class="small mima_wz" style="display:none;" placeholder="请输入新密码" >
                                  <a class="eyes_boxp " data-show="1" href="javascript:void(0);"><i style="margin-left:10px" class="icon-eye-open"></i></a> </span>
                        </div>

                    </div> 
                    <div class="mws-form-row">
        				<label class="mws-form-label">确认密码</label>
        				<div class="mws-form-item">
                                <span>
                                  <input name='repass'   type="password" class="small mima_dd " placeholder="确认密码" >
                                  <input name='repass'  type="text" class="small mima_wz" style="display:none;" placeholder="确认密码" >
                                  <a class="eyes_boxr " data-show="1" href="javascript:void(0);"><i style="margin-left:10px" class="icon-eye-open"></i></a> </span>
        				</div>

        			</div>

        			
        		<div class="mws-button-row">
        			{{csrf_field()}}
        			<input type="submit" value="修改" class="btn btn-primary">
        		</div>
        	</form>
        </div>    	
    </div>
@section('js')

<script>
    $(".eyes_box").click(function(){
    if($(this).attr("data-show")==1){//明文
        $(this).attr("data-show","2");
        $(this).children("i").html("");
        $(this).parent("span").children(".mima_dd").hide();
        $(this).parent("span").children(".mima_wz").show();
        $(this).parent("span").children(".mima_wz").val($(this).parent("span").children(".mima_dd").val()); 
        return;
        }
    if($(this).attr("data-show")==2){//密文
        $(this).attr("data-show","1");
        $(this).children("i").html("");
        $(this).parent("span").children(".mima_dd").show();
        $(this).parent("span").children(".mima_wz").hide();
        $(this).parent("span").children(".mima_dd").val($(this).parent("span").children(".mima_wz").val()); 
        return;
        } 
    });
     $(".eyes_boxp").click(function(){
    if($(this).attr("data-show")==1){//明文
        $(this).attr("data-show","2");
        $(this).children("i").html("");
        $(this).parent("span").children(".mima_dd").hide();
        $(this).parent("span").children(".mima_wz").show();
        $(this).parent("span").children(".mima_wz").val($(this).parent("span").children(".mima_dd").val()); 
        return;
        }
    if($(this).attr("data-show")==2){//密文
        $(this).attr("data-show","1");
        $(this).children("i").html("");
        $(this).parent("span").children(".mima_dd").show();
        $(this).parent("span").children(".mima_wz").hide();
        $(this).parent("span").children(".mima_dd").val($(this).parent("span").children(".mima_wz").val()); 
        return;
        } 
    }); 
     $(".eyes_boxr").click(function(){
    if($(this).attr("data-show")==1){//明文
        $(this).attr("data-show","2");
        $(this).children("i").html("");
        $(this).parent("span").children(".mima_dd").hide();
        $(this).parent("span").children(".mima_wz").show();
        $(this).parent("span").children(".mima_wz").val($(this).parent("span").children(".mima_dd").val()); 
        return;
        }
    if($(this).attr("data-show")==2){//密文
        $(this).attr("data-show","1");
        $(this).children("i").html("");
        $(this).parent("span").children(".mima_dd").show();
        $(this).parent("span").children(".mima_wz").hide();
        $(this).parent("span").children(".mima_dd").val($(this).parent("span").children(".mima_wz").val()); 
        return;
        } 
    });
    //密码隐藏与显示
    //让错误的信息3秒钟之后消失
    /*setInterval(function(){


    },3000)*/

    setTimeout(function(){
        $('.mws-form-message').slideUp(2000);
        // $('.mws-form-message').fadeOut(2000);

    },3000)

    // delay(3000).
   
    


    
</script>

@stop
@stop