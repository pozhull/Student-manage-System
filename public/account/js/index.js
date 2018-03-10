$(function() {
	/*删除老师账户*/
	$(".deleteAccount").click(function() {
		var url = CONST.deleteAccount;
		var id = $(this).attr('data-id');
		swal({ 
		  title: "确定删除吗？", 
		  text: "你将无法恢复该虚拟文件！", 
		  type: "warning",
		  showCancelButton: true, 
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "确定删除！", 
		  closeOnConfirm: false
		},
		function(){
			var data = {
				'id' : id,
			}
			$.ajax({
	            url:      url,  
	            type:     "POST",  
	            dataType: "json",  
	            data:     data,
	            success:function(response){
	            	if (response['status'] == 'success') {
	            		swal({ 
							title: "", 
							text: "删除成功", 
							type: "success",
						},
						function() {
							console.log('1');
		            		window.location.reload();
						}); 
	            		window.location.reload();
	            	} 
	            },  
	            error:function() {  
	  				console.log('删除失败');
	            }  
			});
		});
	});

	/*添加老师账户模态框弹出时清空输入框*/
	$('#createTeacherModal').on('shown.bs.modal', function () {
		// 移除警告框
		if (!$("#createTea-warning").hasClass('hidden')) {
			$("#createTea-warning").addClass('hidden');
		}
		$("#createTea-usernameInp, #createTea-pwdInp, #createTea-pwdTwiceInp, #createTea-licenseInp").val("");
		$("#createTea-usernameInp").focus();
	});

	/*添加学生弹出框*/
	$("#createTeaBtn").click(function() {
		
		if ($("#createTea-pwdInp").val() != $("#createTea-pwdTwiceInp").val()) {
			$("#createTea-warning").removeClass('hidden');
			$("#createTea-warning-msg").html("两次密码输入不一致");
			$("#createTea-pwdTwiceInp").focus().parent().addClass("has-error");
			return false;
		}

		console.log('create a teacher account');
		var url = CONST.createTeacher;
		var data = {
			'username'  : $("#createTea-usernameInp").val(),
			'password'  : $("#createTea-pwdInp").val(),
			'license'   : $("#createTea-licenseInp").val(),
		};
		// console.log(data);
		$.ajax({
            url:      url,  
            type:     "POST",  
            dataType: "json",  
            data:     data,
            success:function(response){
            	if (response['status'] == 'success') {
            		swal({ 
						title: "", 
						text: "添加成功", 
						type: "success",
					},
					function() {
	            		window.location.reload();
					}); 
            		window.location.reload();
            	} else if (response['status'] == 'accountExist') {
					$("#createTea-warning").removeClass('hidden');
					$("#createTea-warning-msg").html("该用户名已存在！");
            		$("#createTea-usernameInp").focus().parent().addClass("has-error");
            	} 
            },  
            error:function() {  
  				console.log('添加失败');
            }  
		});
	});

	/*修改按钮*/
	$(".modifyAccount").click(function() {
		var _that = $(this);
		var username = _that.parent().parent().find('td[data-name="username"]').text();
		$("#modifyUsernameInp").val(username);
		$("#modifyTea-usernameInp").attr('data-oldUser', username);
	});

	/*修改老师账户模态框弹出时设置输入框*/
	$('#modifyTeacherModal').on('shown.bs.modal', function () {
		// 移除警告框
		if (!$("#modifyTea-warning").hasClass('hidden')) {
			$("#modifyTea-warning").addClass('hidden');
		}
		var url = CONST.getSingleTea;
		var data = {
			'username' : $("#modifyUsernameInp").val(),
		}
		$.ajax({
            url:      url,  
            type:     "POST",  
            dataType: "json",  
            data:     data,
            success:function(response){
            	if (response['status'] == 'success') {
            		$("#modifyTea-usernameInp").val(response['username']).focus();
					$("#modifyTea-newpwdInp").val(response['password']);
					$("#modifyTea-newpwdTwiceInp").val(response['password']);
					$("#modifyTea-licenseInp").val(response['license']);
            	} 
            },  
            error:function() {  
  				console.log('删除失败');
            }  
		});
	});

	/*修改弹出框的确定按钮*/
	$("#modifyTeaBtn").click(function() {
		var url = CONST.modifyTeacher;
		var data = {
			'oldusername'   : $("#modifyTea-usernameInp").attr('data-oldUser'),
			'newusername'   : $("#modifyTea-usernameInp").val(),
			'password'      : $("#modifyTea-newpwdInp").val(),
			'license'       : $("#modifyTea-licenseInp").val(),
		};
		console.log(data);
		$.ajax({
            url:      url,  
            type:     "POST",  
            dataType: "json",  
            data:     data,
            success:function(response){
            	if (response['status'] == 'success') {
            		swal({ 
						title: "", 
						text: "修改成功", 
						type: "success",
					},
					function() {
	            		window.location.reload();
					}); 
            		window.location.reload();
            	}
            },  
            error:function() {  
  				console.log('修改失败');
            }  
		});
	})
})