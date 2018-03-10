<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
	<title>学生管理系统</title>
    <link rel="icon" href="{{asset('common/img/favicon.ico')}}">
    <link href="{{asset('static/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('static/sweetalert/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('static/bootstrap/css/ie10-viewport-bug-workaround.css')}}" rel="stylesheet">
    <!-- <link href="{{asset('login/css/login.css')}}" rel="stylesheet"> -->
    <link href="{{asset('common/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('common/css/dashboard.css')}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @section('style')

    @show
    <script type="text/javascript">
        var modifyPwd = "{{$path['modifyPwd']}}";
    </script>
</head>
<body>
	
@section('header')
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="{{url('class/index')}}">学生管理系统</a>
	    </div>
	    <div id="navbar" class="navbar-collapse collapse">
	      <ul class="nav navbar-nav navbar-right">
	        <li class="">
	          <a href="#">成绩管理</a>
	        </li>
	        <li class="{{ Request::getPathInfo() == '/class/index' ||
                    Request::getPathInfo() == '/class/createClass' ||
                    Request::getPathInfo() == '/class/detailClass' 
            ? 'active' : '' }}">
              <a href="{{url('class/index')}}">班级管理</a>
            </li>
            <li class="{{ Request::getPathInfo() == '/course/index' ? 'active' : '' }}">
	          <a href="{{url('course/index')}}">课程管理</a>
            </li>
            <li class="{{ Request::getPathInfo() == '/account/index' ? 'active' : '' }}">
              <a href="{{url('account/index')}}">账号管理</a>
	        </li>
	        <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{$username}} <span class="caret"></span></a>
				<input type="hidden" id="username" value="{{$username}}">
				<ul class="dropdown-menu">
				<li><a href="#" data-toggle="modal" data-target="#myResetPwdModal">修改密码</a></li>
				<li><a href="{{url('login/index')}}">退出登录</a></li>
				</ul>
            </li>
	      </ul>
	    </div>
	  </div>
	</nav>
@show

@section('body')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			@section('leftmenu')
			@show
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			@yield('content')
		</div>
	</div>
</div>
@show

<!-- 修改密码弹出框start -->
<div class="container modal fade" id="myResetPwdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content form-signin">
      <!-- <form class="form-signin" name="resetForm" id="resetForm" method="post" method="{{url('login/resetPwd')}}"> -->

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">修改密码</h4>
        </div>

        <div class="modal-body">
                <!-- 警告框 -->
                <div class="alert alert-danger alert-dismissible hidden" id="modal-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Warning!</strong> 
                    <span id="modal-warning-msg"></span>
                </div>

                <!-- 原密码 -->
                <div class="form-group"  id="resetPwd-old-Div">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon glyphicon-user"></div>
                       <!--  <label for="resetPwd-old" class="sr-only">原密码</label> -->
                        <input type="password"  class="form-control removeWarning" id="resetPwd-old" placeholder="原密码" name="resetPwd-old" value="" required="" >
                    </div>
                </div>

                <!-- 新密码 -->
                <div class="form-group"  id="resetPwd-new-Div">
                    <div class="input-group">
                        <div class="input-group-addon glyphicon glyphicon-credit-card"></div>
                        <label for="resetPwd-new" class="sr-only">新密码</label>
                        <input type="password"  class="form-control removeWarning" id="resetPwd-new" placeholder="新密码" name="resetPwd-new" value="" required="">
                    </div>
                </div>

                <!-- 旧密码 -->
                <div class="form-group"  id="resetPwd-confirm-Div">
                    <div class="input-group">
                        <div class="input-group-addon glyphicon glyphicon-barcode"></div>
                        <label for="resetPwd-confirm" class="sr-only">确定密码</label>
                        <input type="password"  class="form-control removeWarning" id="resetPwd-confirm" placeholder="确定密码" name="resetPwd-confirm" value="" required="">
                    </div>
                </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary" id="modifyPwdBtn">确定</button>
        </div>
      <!-- </form> -->
    </div>
  </div>
</div>
<!-- 修改密码弹出框end -->


<script src="{{asset('static/jquery/jquery.js')}}" ></script>
<script src="{{asset('static/jquery/jquery-ui.min.js')}}" ></script>
<script src="{{asset('static/bootstrap/js/bootstrap.js')}}" ></script>
<script src="{{asset('static/sweetalert/js/sweetalert.js')}}" ></script>
<script src="{{asset('static/bootstrap/js/ie10-viewport-bug-workaround.js.下载')}}"></script>
<script src="{{asset('static/bootstrap/js/ie-emulation-modes-warning.js.下载')}}"></script>
<script src="{{asset('common/js/resetPwd.js')}}" ></script>
@section('javascript')
@show  
</body>
</html>