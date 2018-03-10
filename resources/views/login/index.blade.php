<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
    <title>Student Management System</title>
    <link rel="icon" href="{{asset('common/img/favicon.ico')}}">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('static/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Sweetalert core CSS -->
    <link href="{{asset('static/sweetalert/css/sweetalert.css')}}" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{asset('static/bootstrap/css/ie10-viewport-bug-workaround.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('login/css/login.css')}}" rel="stylesheet">

    <link href="{{asset('common/css/base.css')}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- <link rel="stylesheet" type="text/css" href="../../../public/static/bootstrap/css/ie10-viewport-bug-workaround.css"> -->
    <script type="text/javascript">
        var CONST = {
            "verifyCode": "{{$path['verifyCodePath']}}",
            "resetPwd": "{{$path['resetPwd']}}",
        };

    </script>
</head>

<body>

<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">
            学生管理系统
        </div>
        <div class="panel-body">
            <form class="form-signin" method="post">
                {!! csrf_field() !!}
                <!-- 警告框 -->
                @if (!empty($error))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Warning!</strong> {{$error[1]}}
                </div>
                @endif

                <!-- 学号 -->
                <div class="form-group 
                {{!empty($error) && $error[0] == 'userError'? 'has-error':''}}">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon glyphicon-user"></div>
                        <label for="inputEmail" class="sr-only">请输入学号</label>
                        <input type="text" id="inputEmail" class="form-control removeWarning" placeholder="请输入学号" name="username" value="{{$data['username']}}" required="" autofocus="">
                    </div>
                </div>

                <!-- 密码 -->
                <div class="form-group
                {{!empty($error) && $error[0] == 'userError'? 'has-error':''}}">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon glyphicon-lock"></div>
                        <label for="inputPassword" class="sr-only">请输入密码</label>
                        <input type="password" id="inputPassword" class="form-control removeWarning" placeholder="请输入密码" name="password" value="{{$data['password']}}" required="">
                    </div>
                </div>
                
                <!-- 验证码 -->
                <div class="form-group verifyCodeDiv 
                {{!empty($error) && $error[0] == 'verifyCodeError'? 'has-error':''}}">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon glyphicon-barcode"></div>
                        <input type="text" id="inputVerifyCode" class="form-control removeWarning" placeholder="请输入验证码" name="verifyCode" required="">
                        <img class="verifyCodeImg" id="verifyCodeImg" src="{{ url('login/verifyCode') }}">
                    </div>
                </div>

                <!-- 用户类型 -->
                <div class="form-group">    
                    <label class="radio-inline col-6">
                        <input type="radio" name="type" id="radioTeacher" value="teacher" {{$data['type'] == 'teacher' ? 'checked' : ''}}> 老师
                    </label>
                    <label class="radio-inline col-6">
                        <input type="radio" name="type" id="radioStudent" value="student" {{$data['type'] != 'teacher' ? 'checked' : ''}}> 学生
                    </label>
                    <a href="#" class="btn btn-link pull-right forgetPwd" id="forgetPwd" data-toggle="modal" data-target="#myModal">忘记密码？</a>
                </div>

                <!-- 登录按钮 -->
                <div class="form-group">
                    <button class="form-control btn btn-lg btn-primary btn-block" type="submit">登录</button>
                </div>
            </form>
        </div>
    </div>

</div> <!-- /container -->


<!-- 忘记密码弹出框start -->
<div class="container modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content form-signin">
      <!-- <form class="form-signin" name="resetForm" id="resetForm" method="post" method="{{url('login/resetPwd')}}"> -->

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">找回密码</h4>
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

                <!-- 学号 -->
                <div class="form-group"  id="resetUsernameDiv">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon glyphicon-user"></div>
                        <label for="resetUsername" class="sr-only">请输入学号</label>
                        <input type="text"  class="form-control removeWarning" id="resetUsername" placeholder="请输入学号" name="resetUsername" value="" required="" >
                    </div>
                </div>

                <!-- 凭据 -->
                <div class="form-group"  id="resetLicenseDiv">
                    <div class="input-group">
                        <div class="input-group-addon glyphicon glyphicon-credit-card"></div>
                        <label for="resetLicense" class="sr-only">请输入凭据</label>
                        <input type="text"  class="form-control removeWarning" id="resetLicense" placeholder="请输入凭据" name="resetLicense" value="" required="">
                    </div>
                </div>

                <!-- 验证码 -->
                <div class="form-group"  id="resetVerifyCodeDiv">
                    <div class="input-group verifyCodeDiv">   
                        <div class="input-group-addon glyphicon glyphicon-barcode"></div>
                        <input type="text"  class="form-control removeWarning" placeholder="请输入验证码" id="resetVerifyCode" name="resetVerifyCode" required="">
                        <img class="verifyCodeImg" id="resetVerifyCodeImg" src="{{ url('login/verifyCode') }}">
                    </div>
                </div>
        </div>

        <div class="modal-footer">
            <p class="text-primary pull-left">凭据为身份证号</p>
            <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary" id="resetPwdBtn">找回密码</button>
        </div>
      <!-- </form> -->
    </div>
  </div>
</div>
<!-- 忘记密码弹出框end -->

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{asset('static/jquery/jquery.js')}}" ></script>
<script src="{{asset('static/jquery/jquery-ui.min.js')}}" ></script>
<script src="{{asset('static/bootstrap/js/bootstrap.js')}}" ></script>
<script src="{{asset('static/sweetalert/js/sweetalert.js')}}" ></script>
<script src="{{asset('static/bootstrap/js/ie10-viewport-bug-workaround.js.下载')}}"></script>
<script src="{{asset('static/bootstrap/js/ie-emulation-modes-warning.js.下载')}}"></script>   
<script src="{{asset('login/js/login.js')}}"></script>

</body></html>