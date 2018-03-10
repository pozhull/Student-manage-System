
$(function() {

	//模态框弹出时清空输入框
	$('#myResetPwdModal').on('shown.bs.modal', function () {
		if (!$("#modal-warning").hasClass('hidden')) {
			$("#modal-warning").addClass('hidden');
		}
		$("#resetPwd-old").focus();
		$("#resetPwd-old, #resetPwd-new, #resetPwd-confirm").val("").parent().parent().removeClass("has-error");
		// $("#resetPwd-new").val("").parent().parent().removeClass("has-error");
		// $("#resetPwd-confirm").val("").parent().parent().removeClass("has-error");
	});

	//修改密码
	$("#modifyPwdBtn").click(function() {
		console.log('resetpwd');
		var url = modifyPwd;
		var username = $("#username").val();
		var resetPwdOld = $("#resetPwd-old").val();
		var resetPwdNew = $("#resetPwd-new").val();
		var resetPwdConfirm = $("#resetPwd-confirm").val();
		var data = {
			"username"     : username,
			"resetPwdOld"  : resetPwdOld,
			"resetPwdNew"  : resetPwdNew,
		}

		// 两次密码输入不一致
		if (resetPwdNew != resetPwdConfirm) {
			$("#resetPwd-old").parent().parent().removeClass("has-error");
			$("#modal-warning").removeClass('hidden');
			$("#modal-warning-msg").html("两次密码输入不一致");
			$("#resetPwd-confirm").val("").focus().parent().parent().addClass('has-error');
			return false;
		} else if (resetPwdOld == resetPwdNew) {
			$("#resetPwd-old").parent().parent().removeClass("has-error");
			$("#modal-warning").removeClass('hidden');
			$("#modal-warning-msg").html("新密码和旧密码一致");
			$("#resetPwd-new").focus();
			$("#resetPwd-new, #resetPwd-confirm").val("").parent().parent().addClass('has-error');
			return false;
		}

		// console.log(data);
		console.log(url);
		$.ajax({
            url:      url,  
            type:     "POST",  
            dataType: "json",  
            data:     data,
            success:function(response){ 
            	if (response['status'] == 'success') {
            		// console.log('success');
            		swal({ 
  					  title: "Success", 
  					  text: "修改成功", 
  					  type: "success",
  					  showCancelButton: false, 
  					  html: true,
  					},
  					function(){
  					  $("#myResetPwdModal .close").click(); 
  					});
  					window.location.reload();
            	} else if (response['status'] == 'oldPwdError') {
            		$("#resetPwd-new, #resetPwd-confirm").parent().parent().removeClass("has-error");
            		$("#modal-warning").removeClass('hidden');
            		$("#modal-warning-msg").html("原密码输入错误");
            		$("#resetPwd-old").val("").focus().parent().parent().addClass('has-error');
            	} 
            },  
            error:function() {  
  				console.log('修改失败');
            }  
		});
	});

})
