@extends('common.layouts')

@section('style')
	<script type="text/javascript">
	    var CONST = {
	        "deleteAccount": "{{$path['deleteAccount']}}",
	        "createTeacher": "{{$path['createTeacher']}}",
	        "getSingleTea": "{{$path['getSingleTea']}}",
	        "modifyTeacher": "{{$path['modifyTeacher']}}",
	    };
	</script>
@stop

@section('leftmenu')
	@include('account._leftmenu')
@stop

@section('content')
	<h1 class="page-header">教师账户</h1>
	<div class="row">
  		<div class="col-lg-2 col-md-4 col-sm-6 media">
			<input type="button" class="btn btn-primary form-control" name="" value="添加账户" id="createTeacher"  data-toggle="modal" data-target="#createTeacherModal">
			<input type="hidden" name="" id="modifyUsernameInp">
		</div>
  	</div>
	<div class="table-responsive media">
	  	<table class="table table-striped table-hover table-responsive">
		    <thead>
		      	<tr>
		        	<th>编号</th>
			        <th>账户</th>
			        <th>密码</th>
			        <th>凭证</th>
			        <th>操作</th>
		      	</tr>
		    </thead>
		    <tbody>
				@if (isset($accounts) && $accounts->count() > 0)
			    	<?php $key=1?>
			    	@foreach($accounts as $account)
						<tr>
							<td>{{$key++}}</td>
							<td data-name="username">{{$account->username}}</td>
							<td data-name="password">{{substr(Crypt::encrypt($account->password), -16)}}</td>
							<td data-name="license">{{substr(Crypt::encrypt($account->license), -10)}}</td>
							<td>
								<a href="#" class="modifyAccount" data-id='{{$account->id}}' data-toggle="modal" data-target="#modifyTeacherModal">修改</a>
								<a href="#" class="deleteAccount" data-id='{{$account->id}}'>删除</a>
							</td>
						</tr>
			    	@endforeach
				@else
	    			<tr><td colspan="5">暂无数据</td></tr>
	    		@endif
		    </tbody>
	  	</table>
	</div>

	@include('account._createTeacher')
	@include('account._modifyTeacher')
@stop

@section('javascript')
<script src="{{asset('account/js/index.js')}}" ></script>
@stop
