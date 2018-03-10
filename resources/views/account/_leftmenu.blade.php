<ul class="nav nav-sidebar">
	<li class="{{ Request::getPathInfo() == '/account/index' ? 'active' : '' }}">	
		<a href="{{url('account/index')}}">教师账户</a>
	</li>
	<li class="">	
		<a href="#">学生账户</a>
	</li>
</ul> 	