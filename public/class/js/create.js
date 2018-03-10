
$(function(){

	var oldgradeVal = $("#gradeSel").val();
	var oldclassVal = $("#classSel").val();
	var oldclassVal2 = oldclassVal < 10 ? '0' + oldclassVal : oldclassVal;
	var oldClass = oldgradeVal + '' + oldclassVal2;
	/*初始化页面时显示对应的按钮*/
	if ($("#gradeSel").val() != 0 && $("#classSel").val() != 0) {
		$("#classModify, #createStudent").parent().removeClass('hidden');
		$("#gradeSel, #classSel").attr('disabled', 'disabled');
		$("#classConfirm").parent().addClass('hidden');
	}

	/*确定按钮*/
	$("#classConfirm").click(function() {
		var newGradeVal = $("#gradeSel").val();
		var newClassVal = $("#classSel").val();
		var newClassVal2 = newClassVal < 10 ? '0' + newClassVal : newClassVal;
		var newClass = newGradeVal + '' + newClassVal2;
		console.log('old:' + oldClass + '--newClass:' + newClass);
		// console.log('1');
		if (newGradeVal == 0 || newClassVal == 0) {
			swal("请选择班级和年级", "","warning");
			return false;
		} else {
			var url = CONST.modifyClass;
			// console.log(url);
			var data = {
				'classOld' : oldClass,
				'classNew' : newClass,
			}
			if (newClass != oldClass) {
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
								// console.log('1');
			            		// window.location.reload();
			            		location.search = "?grade="+ newGradeVal + "&class=" + newClassVal;
			            		$("#classModify, #createStudent").parent().removeClass('hidden');
					    		$("#gradeSel, #classSel").attr('disabled', 'disabled');
					    		$("#classConfirm").parent().addClass('hidden');
							}); 
		            		location.search = "?grade="+ newGradeVal + "&class=" + newClassVal;
		            	} else if (response['status'] == 'classExist') {
		            		swal("该班级已存在", "","warning");
		            		console.log(newGradeVal+newClassVal);
		            		$("#gradeSel").val(newGradeVal);
		            		$("#classSel").val(newClassVal);
		            	} else if (response['status'] == 'createSuccess') {
		            		$("#classModify, #createStudent").parent().removeClass('hidden');
				    		$("#gradeSel, #classSel").attr('disabled', 'disabled');
				    		$("#classConfirm").parent().addClass('hidden');
		            	}
		            },  
		            error:function() {  
		  				console.log('修改失败');
		            }  
				});
			} else {
				$("#classModify, #createStudent").parent().removeClass('hidden');
	    		$("#gradeSel, #classSel").attr('disabled', 'disabled');
	    		$("#classConfirm").parent().addClass('hidden');
			}
		}
	});

	/*修改按钮*/
	$("#classModify").click(function(){
		$("#classModify, #createStudent").parent().addClass('hidden');
		$("#gradeSel, #classSel").removeAttr('disabled');
		$("#classConfirm").parent().removeClass('hidden');

	});

	/*修改学生信息*/
	$(".student-modify-btn").click(function() {

		var newgradeVal = $("#gradeSel").val();
		var newclassVal = $("#classSel").val();
		var newclassVal2 = newclassVal < 10 ? '0' + newclassVal : newclassVal;
		var newClass = newgradeVal + '' + newclassVal2;
		var data = {
			'studentId'        : $(this).attr("data-id"),
			'name'             : $(this).parent().parent().find('td[data-name="name"]').text(),
			'identify'         : $(this).parent().parent().find('td[data-name="identify"]').text(),
			'sex'              : $(this).parent().parent().find('td[data-name="sex"]').text(),
			'age'              : $(this).parent().parent().find('td[data-name="age"]').text(),
			'entranceDate'     : $(this).parent().parent().find('td[data-name="entranceDate"]').text(),
			'gradeVal'         : newgradeVal,
			'classVal'         : newclassVal,
		}
		console.log(data);
		$('#modifyStudentModal').on('shown.bs.modal', function () {
			// 移除警告框
			if (!$("#modifyStu-warning").hasClass('hidden')) {
				$("#modifyStu-warning").addClass('hidden');
			}

			$("#modifyStu-studentIdInp").val(data.studentId).focus().attr('data-oldId', data.studentId);
			$("#modifyStu-nameInp").val(data.name);
			$("#modifyStu-identifyInp").val(data.identify);
			$("input[name='modifyStu-sexInp'][value='" + data.sex + "']").attr('checked', 'true');
			$("#modifyStu-ageInp").val(data.age);
			$("#modifyStu-entranceDateInp").val(data.entranceDate);
			$("#modifyStu-gradeSel").val(data.gradeVal);
			$("#modifyStu-classSel").val(data.classVal);
		});
	});

	/*修改信息弹出框*/
	$("#modifyStuBtn").click(function() {
		console.log('modify the student\'s info');
		var url = CONST.modifyStudent;
		var newgradeVal = $("#modifyStu-gradeSel").val();
		var newclassVal = $("#modifyStu-classSel").val();
		var newclassVal2 = newclassVal < 10 ? '0' + newclassVal : newclassVal;
		var newClass = newgradeVal + '' + newclassVal2;
		var data = {
			'oldStudentId'  : $("#modifyStu-studentIdInp").attr('data-oldId'),
			'newStudentId'  : $("#modifyStu-studentIdInp").val(),
			'name'          : $("#modifyStu-nameInp").val(),
			'identify'      : $("#modifyStu-identifyInp").val(),
			'sex'           : $("input[name='modifyStu-sexInp']:checked").val(),
			'age'           : $("#modifyStu-ageInp").val(),
			'entranceDate'  : $("#modifyStu-entranceDateInp").val(),
			'class'         : newClass,
		};
		console.log(data);
		$.ajax({
            url:      url,  
            type:     "POST",  
            dataType: "json",  
            data:     data,
            success:function(response){
            	if (response['status'] == 'success') {
            		// localStorage['studentId'] = data.studentId;
            		// localStorage['entranceDate'] = data.entranceDate;
            		swal({ 
						title: "", 
						text: "修改成功", 
						type: "success",
					},
					function() {
	            		window.location.reload();
					}); 
            		window.location.reload();
            	} else if (response['status'] == 'studentExist') {
  					$("#modifyStu-warning").removeClass('hidden');
  					$("#modifyStu-warning-msg").html("该学号已经存在");
  					$("#modifyStu-studentIdInp").focus().parent().addClass('has-error');
            	} else if (response['status'] == 'noChange') {
            		swal("请修改数据", "", "warning");
            	}
            },  
            error:function() {  
  				console.log('修改失败');
            }  
		});
	});

	/*删除学生*/
	$(".student-del-btn").click(function() {
		var url = CONST.deleteStudent;
		// console.log(url);
		var studentID = $(this).attr('data-id');
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
				'studentID' : studentID,
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

	/*添加学生模态框弹出时清空输入框*/
	$('#createStudentModal').on('shown.bs.modal', function () {
		// 移除警告框
		if (!$("#createStu-warning").hasClass('hidden')) {
			$("#createStu-warning").addClass('hidden');
		}

		// 赋予日期值
		if (localStorage['studentId']) {
			$("#studentIdInp").val(parseInt(localStorage['studentId'])+1).parent().removeClass('has-error');
			$("#nameInp").focus();
		} else {
			$("#studentIdInp").val("").focus().parent().removeClass('has-error');
		}
		
		$("#createStudentModal").find("#nameInp, #identifyInp, #ageInp").val("");

		// 赋予日期值
		if (localStorage['entranceDate']) {
			$("#entranceDateInp").val(localStorage['entranceDate']);
		} else {
			var nowDate = new Date();
		 	var year = nowDate.getFullYear();
		 	var month = nowDate.getMonth() + 1 < 10 ? "0" + (nowDate.getMonth() + 1)
		 				: nowDate.getMonth() + 1;
		 	var day = nowDate.getDate() < 10 ? "0" + nowDate.getDate() : nowDate.getDate();
		 	var dateStr = year + "-" + month + "-" + day;
			$("#entranceDateInp").val(dateStr);
		}
	});

	/*添加学生弹出框*/
	$("#createStuBtn").click(function() {
		console.log('create a student');
		var url = CONST.createStudent;
		var newgradeVal = $("#gradeSel").val();
		var newclassVal = $("#classSel").val();
		var newclassVal2 = newclassVal < 10 ? '0' + newclassVal : newclassVal;
		var newClass = newgradeVal + '' + newclassVal2;
		var data = {
			'studentId'     : $("#studentIdInp").val(),
			'name'          : $("#nameInp").val(),
			'identify'      : $("#identifyInp").val(),
			'sex'           : $("input[name='sexInp']:checked").val(),
			'age'           : $("#ageInp").val(),
			'entranceDate'  : $("#entranceDateInp").val(),
			'class'         : newClass,
		};
		console.log(data);
		$.ajax({
            url:      url,  
            type:     "POST",  
            dataType: "json",  
            data:     data,
            success:function(response){
            	if (response['status'] == 'success') {
            		localStorage['studentId'] = data.studentId;
            		localStorage['entranceDate'] = data.entranceDate;
            		swal({ 
						title: "", 
						text: "添加成功", 
						type: "success",
					},
					function() {
	            		location.search = "?grade="+ newgradeVal + "&class=" + newclassVal;
					}); 
            		location.search = "?grade="+ newgradeVal + "&class=" + newclassVal;
            	} else if (response['status'] == 'studentExist') {
  					$("#createStu-warning").removeClass('hidden');
  					$("#createStu-warning-msg").html("该学号已经存在");
  					$("#studentIdInp").val("").focus().parent().addClass('has-error');
            	}
            },  
            error:function() {  
  				console.log('添加失败');
            }  
		});
	});
})