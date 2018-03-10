@extends('common.layouts')

@section('style')
	<script type="text/javascript">
	    var CONST = {
	        "deleteCourse": "{{$path['deleteCourse']}}",
	        "createCourse": "{{$path['createCourse']}}",
	        "modifyCourse": "{{$path['modifyCourse']}}",
	    };
	</script>
@stop

@section('body')
	<div class="container">
	  	<h1 class="page-header">课程列表</h1>
	  	<div class="row">
	  		<div class="col-lg-2 col-md-4 col-sm-6 media">
  				<input type="button" class="btn btn-primary form-control" name="" value="添加课程" id="createCourse"  data-toggle="modal" data-target="#createCourseModal">
  			</div>
	  	</div>
	  	<div class="row media" style="width:1140px;margin: 15px auto">
	      	<div class="panel panel-default">
	          	<table class="table table-striped table-hover table-responsive">
	              	<thead>
		              	<tr>
		                  	<th>ID</th>
		                  	<th>课程</th>
		                  	<th>总分</th>
		                  	<th>备注</th>
		                  	<th width="120">操作</th>
	             	 	</tr>
             	 	</thead>
             	 	<tbody>
 	 					@if (isset($courses) && $courses->count() > 0)
 	 				    	<?php $key=1?>
 	 				    	@foreach($courses as $course)
 	 							<tr>
 	 								<td>{{$key++}}</td>
 	 								<td data-name="coursename">{{$course->coursename}}</td>
 	 								<td data-name="coursegrade">{{$course->coursegrade}}</td>
 	 								<td data-name="coursedesc">{{$course->coursedesc}}</td>
 	 								<td>
 	 									<a href="#" class="modifyCourse" data-id='{{$course->courseid}}' data-toggle="modal" data-target="#modifyCourseModal">修改</a>
 	 									<a href="#" class="deleteCourse" data-id='{{$course->courseid}}'>删除</a>
 	 								</td>
 	 							</tr>
 	 				    	@endforeach
 	 					@else
 	 		    			<tr><td colspan="5">暂无班级</td></tr>
 	 		    		@endif
		              	</tbody>
		          </table>
	      	</div>
	  	</div>
	</div>
	@include('course._createCourse')
	@include('course._modifyCourse')
@stop

@section('javascript')
<script src="{{asset('course/js/index.js')}}" ></script>
@stop