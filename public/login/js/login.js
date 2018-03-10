$(function() {	
	//点击验证码刷新
	$(".verifyCodeImg").on("click", function() {
		var path = CONST.verifyCode;
		$(this).attr({src: path});
		$("#inputVerifyCode").val("");
	});

	//验证码bug处理
	$("#forgetPwd, .modal-header .close, #cancel").on("click", function() {
		var ele;
		var path = CONST.verifyCode;
		if ($(this).hasClass('forgetPwd')) {
			ele = $("#resetVerifyCodeImg");
		} else {
			ele = $("#verifyCodeImg");
		}
		ele.attr({src: path});
	})

	//input值改变时去除警告框;
	$(".removeWarning").on("input propertychange", function() {
		if ($(this).val() !== "") {
			$(this).parent().parent().removeClass("has-error");
		}
	});

	//模态框弹出时清空输入框
	$('#myModal').on('shown.bs.modal', function () {
		if (!$("#modal-warning").hasClass('hidden')) {
			console.log('有错误吧');
			$("#modal-warning").addClass('hidden');
		}
		$("#resetUsername").focus();
		$("#resetUsername").val("");
		$("#resetLicense").val("");
		$("#resetVerifyCode").val("");
	});

	/*点击找回密码按钮实现响应*/
	$("#resetPwdBtn").click(function(event) {

		console.log('找回密码');
		/* Act on the event */
		var url = CONST.resetPwd;
		var data = {
			"resetUsername":    $("#resetUsername").val(), 
			"resetLicense":     $("#resetLicense").val(), 
			"resetVerifyCode":  $("#resetVerifyCode").val(), 
		};

		if (data.resetUsername == "") {
			$("#modal-warning").removeClass('hidden');
			$("#modal-warning-msg").html("请输入学号");
			$("#resetUsername").focus();
			return false;
		}
		if (data.resetLicense == "") {
			$("#modal-warning").removeClass('hidden');
			$("#modal-warning-msg").html("请输入凭据");
			$("#resetLicense").focus();
			return false;
		}
		if (data.resetVerifyCode == "") {
			$("#modal-warning").removeClass('hidden');
			$("#modal-warning-msg").html("请输入验证码");
			$("#resetVerifyCode").focus();
			return false;
		}
		$.ajax({
            url:      url,  
            type:     "POST",  
            dataType: "json",  
            data:     data,
            success:function(response){  
  				// console.log('重置成功');
  				/*验证码错误*/
  				if (response['status'] == 'verifyCodeError') {
  					$("#modal-warning").removeClass('hidden');
  					$("#modal-warning-msg").html(response['msg']);
  					$("#resetVerifyCodeDiv").addClass('has-error');
  					$("#resetVerifyCode").val("");
  					$("#resetVerifyCode").focus();

  				/*学号或凭据错误*/
  				} else if (response['status'] == 'notFound') {
  					$("#modal-warning").removeClass('hidden');
  					$("#modal-warning-msg").html(response['msg']);
  					$("#resetUsernameDiv").addClass('has-error');
  					$("#resetLicenseDiv").addClass('has-error');
  					// $("#resetUsername").val("");
  					// $("#resetLicense").val("");
  					$("#resetUsername").focus();
  				/*成功找密码*/
  				} else if (response['status'] == 'success') {
  					$("#modal-warning").addClass('hidden');
  					$("#resetUsernameDiv").removeClass('has-error');
  					$("#resetLicenseDiv").removeClass('has-error');

					removeRestInp();
  					// swal("信息", "您的密码为：" + response['msg'] + ", 登录后请尽快修改"

  					// 	// "您的密码为：" + response['msg']
  					// 	);
  					swal({ 
  					  title: "Success", 
  					  text: "您的密码为：<span style='font-weight:bold'>" + response['msg'] + "</span>, 登录后请尽快修改", 
  					  // text: "自定义<span style='color:#F8BB86'>html<span>信息。",
  					  type: "success",
  					  showCancelButton: false, 
  					  html: true,
  					  // confirmButtonColor: "#DD6B55",
  					  // confirmButtonText: "确定删除！", 
  					  // closeOnConfirm: false
  					},
  					function(){
  					  // swal("删除！", "你的虚拟文件已经被删除。", "success");
  					  $(".modal-header .close").click(); 
  					});
  				}

            },  
            error:function() {  
  				console.log('重置失败');
            }  
		});
	});

	/*清空弹出框中输入框的内容*/
	function removeRestInp() {
		$("#resetUsername").val("");
		$("#resetLicense").val("");
		$("#resetVerifyCode").val("");
	}
});
