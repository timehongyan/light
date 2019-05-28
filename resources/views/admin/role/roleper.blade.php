@extends('common.admins')

@section('title','角色权限访问页面')

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
        	<form class="mws-form" action="/admins/doroleper?rid={{$res->id}}" method='post' >
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">角色名</label>
        				<div class="mws-form-item">
        					<input type="text" name='rolename' class="small" value="{{$res->rolename}}" disabled>
        				</div>
        			</div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">权限名称</label>
                        <div class="mws-form-item clearfix">
                            <ul class="mws-form-list inline">
                                @foreach($pers as $k => $v)

                                    @if(in_array($v->id, $arr))
                                        <li><label><input type="checkbox"  name='perid[]' value="{{$v->id}}" checked> {{$v->pername}}</label></li>
                                    @else
                                        <li><label><input type="checkbox"  name='perid[]' value="{{$v->id}}" > {{$v->pername}}</label></li>

                                    @endif
                                @endforeach

                               
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