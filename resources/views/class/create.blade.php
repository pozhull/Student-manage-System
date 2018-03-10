@extends('common.layouts')

<!-- 头部 -->
@section('style')
@section('style')
	<script type="text/javascript">
	    var CONST = {
	        "deleteStudent": "{{$path['deleteStudent']}}",
	        "modifyClass": "{{$path['modifyClass']}}",
	        "createStudent": "{{$path['createStudent']}}",
	        "modifyStudent": "{{$path['modifyStudent']}}",
	    };
	</script>
<?php
$classInfo = array(
	'10' => '高一',
	'11' => '高二',
	'12' => '高三',
); 
?>
@stop
@stop

<!-- 左边侧边栏 -->
@section('leftmenu')
	@include('class.leftmenu')
@stop

<!-- 右边内容区 -->
@section('content')
	@if (Request::getPathInfo() == '/class/createClass')
		<h1 class="page-header">添加班级</h1>
	@elseif (Request::getPathInfo() == '/class/detailClass')
		<h1 class="page-header">{{$classInfo[Request::get('grade')] . Request::get('class')}}班</h1>
	@endif
	@include('class._formStudent')
	@include('class._createStudentSwal')
	@include('class._modifyStudentSwal')
@stop

<!-- 外部js文件的引入 -->
@section('javascript')
<script src="{{asset('class/js/create.js')}}" ></script>
@stop