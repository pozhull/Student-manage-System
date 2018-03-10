<ul class="nav nav-sidebar">
	<li class="{{ Request::getPathInfo() == '/class/index' ? 'active' : '' }}">	
		<a href="{{url('class/index')}}">班级管理</a>
	</li>
	<li class="{{ Request::getPathInfo() == '/class/createClass' ? 'active' : '' }}">	
		<a href="{{url('class/createClass')}}">添加班级</a>
	</li>
</ul> 	