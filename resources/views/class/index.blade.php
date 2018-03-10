@extends('common.layouts')

@section('style')
	<script type="text/javascript">
	    var CONST = {
	        "deleteClass": "{{$path['deleteClass']}}",
	        "detailClass": "{{url('class/detailClass')}}",
	    };
	</script>
@stop

@section('leftmenu')
	@include('class.leftmenu')
@stop

@section('content')
	<h1 class="page-header">班级管理</h1>
	<!-- <h2 class="sub-header">班级管理</h2> -->
  	<div>

	  <!-- Nav tabs -->
  		<ul class="nav nav-tabs" role="tablist">
	    	<li role="presentation" class="active">
	    		<a href="#gradeOne" aria-controls="gradeOne" role="tab" data-toggle="tab">高一</a>
	    	</li>
	    	<li role="presentation">
	    		<a href="#gradeTwo" aria-controls="gradeTwo" role="tab" data-toggle="tab">高二</a>
	    	</li>
	    	<li role="presentation">
	    		<a href="#gradeThree" aria-controls="gradeThree" role="tab" data-toggle="tab">高三</a>
	    	</li>
  		</ul>

	  <!-- Tab panes -->

    	<!-- 高一 -->
	  	<div class="tab-content">
	    	<div role="tabpanel" class="tab-pane active" id="gradeOne">
				<div class="table-responsive">
				  	<table class="table table-striped table-hover table-responsive">
					    <thead>
					      <tr>
					        <th>编号</th>
					        <th>年级</th>
					        <th>班级</th>
					        <th>人数</th>
					        <th>操作</th>
					      </tr>
					    </thead>
					    <tbody>
							@if (isset($students) && $students->filter(function ($value, $key) {return (int)$key > 1000 
							&& (int)$key < 1100;})->count() > 0)
						    	<?php $key=1?>
						    	@foreach($students->filter(function ($value, $key) {return (int)$key > 1000 
							&& (int)$key < 1100;}) as $student)
									<tr>
										<td>{{$key++}}</td>
										<td>{{$student->first()->getGrade($student->first()->class)}}</td>
										<td>{{$student->first()->class%100}}班</td>
										<td>{{$student->count()}}</td>
										<td>
											<a href="#" class="detailClass" data-id='{{$student->first()->class}}'>详情</a>
											<a href="#" class="course-del-btn" data-id='{{$student->first()->class}}'>删除</a>
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
	    	<!-- 高二 -->
	    	<div role="tabpanel" class="tab-pane" id="gradeTwo">
				<div class="table-responsive">
					  <table class="table table-striped table-hover table-responsive">
					    <thead>
					      <tr>
					        <th>编号</th>
					        <th>年级</th>
					        <th>班级</th>
					        <th>人数</th>
					        <th>操作</th>
					      </tr>
					    </thead>
					    <tbody>
							@if (isset($students) && $students->filter(function ($value, $key) {return (int)$key > 1100 
							&& (int)$key < 1200;})->count() > 0)
						    	<?php $key=1?>
						    	@foreach($students->filter(function ($value, $key) {return (int)$key > 1100 
							&& (int)$key < 1200;}) as $student)
									<tr>
										<td>{{$key++}}</td>
										<td>{{$student->first()->getGrade($student->first()->class)}}</td>
										<td>{{$student->first()->class%100}}班</td>
										<td>{{$student->count()}}</td>
										<td>
											<a href="#" class="detailClass" data-id='{{$student->first()->class}}'>详情</a>
											<a href="#" class="course-del-btn" data-id='{{$student->first()->class}}'>删除</a>
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
	    	<!-- 高三 -->
	    	<div role="tabpanel" class="tab-pane" id="gradeThree">
				<div class="table-responsive">
					  <table class="table table-striped table-hover table-responsive">
					    <thead>
					      <tr>
					        <th>编号</th>
					        <th>年级</th>
					        <th>班级</th>
					        <th>人数</th>
					        <th>操作</th>
					      </tr>
					    </thead>
					    <tbody>
							@if (isset($students) && $students->filter(function ($value, $key) {return (int)$key > 1200 && (int)$key < 1300;})->count() > 0)
						    	<?php $key=1?>
						    	@foreach($students->filter(function ($value, $key) {return (int)$key > 1200 
							&& (int)$key < 1300;}) as $student)
									<tr>
										<td>{{$key++}}</td>
										<td>{{$student->first()->getGrade($student->first()->class)}}</td>
										<td>{{$student->first()->class%100}}班</td>
										<td>{{$student->count()}}</td>
										<td>
											<a href="#" class="detailClass" data-id='{{$student->first()->class}}'>详情</a>
											<a href="#" class="course-del-btn" data-id='{{$student->first()->class}}'>删除</a>
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

	</div>

@stop

@section('javascript')
<script src="{{asset('class/js/index.js')}}" ></script>
@stop