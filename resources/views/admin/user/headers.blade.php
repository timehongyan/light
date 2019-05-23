@extends('common.admins')

@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>{{$title}}</span>
        </div>
        <div class="mws-panel-body no-padding">

        	<form id="art_form" class="mws-form" action="/admins/users/uploads" method='post' enctype='multipart/form-data'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
                    	<label class="mws-form-label" ><p style="color:red">{{$rs->username}}</p>头像</label>
                    	<input type="hidden" name="id" value="{{$id}}">
                    	<div class="mws-form-item">
                    		@if(!$rs)
                    			<img id='imgs' src="/uploads/img_30001558253924.jpeg" alt="" style="width:160px">
                    		@else
                    			<img id='imgs' src="{{$rs->header}}" alt="" style="width:160px">
                    		@endif
                        	<input id='file_upload' type="file" name='file_upload' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                    		
                        </div>
                    </div>
        		</div>
        		<div class="mws-button-row">
        			{{csrf_field()}}
        		</div>
        	</form>


        </div>    	
    </div>
@stop

@section('js')
<script>

	// alert($);

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
		            url: "/admins/users/uploads",
		            data: formData,
		            contentType: false,
		            processData: false,
		            success: function(data) {
		                $('#imgs').attr('src',data);
		                // return false;
		                location.href ='/admins/user';
		            },

		            error: function(XMLHttpRequest, textStatus, errorThrown) {
		                alert("上传失败，请检查网络后重试");
		            }
		        });
        })
    })




   



</script>


@stop
