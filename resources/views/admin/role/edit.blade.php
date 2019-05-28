@extends('common.admins')

@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span>{{$title}}</span>
        </div>
        <div class="mws-panel-body no-padding">
        	<form class="mws-form" action="/admins/role/{{$rs->id}}" method='post'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">角色名</label>
        				<div class="mws-form-item">
        					<input type="text" name='rolename' class="small" value='{{$rs->rolename}}'>
        				</div>
        			</div>

        			<div class="mws-form-row">
        				<label class="mws-form-label">状态</label>
        				<div class="mws-form-item clearfix">
        					<ul class="mws-form-list inline">
        						<ul class="mws-form-list inline">
                                <li><label><input type="radio" name='status' value='1' @if($rs->status==1)checked @endif> 开启</label></li>
                                <li><label><input type="radio" name='status' value='0' @if($rs->status==0)checked @endif> 禁用</label></li>
                            </ul>
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