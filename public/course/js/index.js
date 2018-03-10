$(function() {
	/*删除课程*/
	$(".deleteCourse").click(function() {
		var url = CONST.deleteCourse;
		var courseid = $(this).attr('data-id');
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
				'courseid' : courseid,
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


	/*添加课程模态框弹出时清空输入框*/
	$('#createCourseModal').on('shown.bs.modal', function () {
		// 移除警告框
		if (!$("#createCourse-warning").hasClass('hidden')) {
			$("#createCourse-warning").addClass('hidden');
		}
		$("#createCourse-coursename, #createCourse-coursegrade, #createCourse-coursedesc").val("");
		$("#createCourse-coursename").focus();
	});

	/*添加学生弹出框*/
	$("#createCourseBtn").click(function() {
		
		// console.log('create a course');
		var url = CONST.createCourse;
		var data = {
			'courseid'     : '4',
			'coursename'   : $("#createCourse-coursename").val(),
			'coursegrade'  : $("#createCourse-coursegrade").val(),
			'coursedesc'   : $("#createCourse-coursedesc").val(),
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
            	}
            },  
            error:function() {  
  				console.log('添加失败');
            }  
		});
	});

	/*修改按钮*/
	$(".modifyCourse").click(function() {
		var _that = $(this);

		/*添加课程模态框弹出时清空输入框*/
		$('#modifyCourseModal').on('shown.bs.modal', function () {
			// 移除警告框
			if (!$("#modifyCourse-warning").hasClass('hidden')) {
				$("#modifyCourse-warning").addClass('hidden');
			}
			var data = {
				'courseid'  : _that.attr('data-id'),
				'coursename' : _that.parent().parent().find('td[data-name="coursename"]').text(),
				'coursegrade' : _that.parent().parent().find('td[data-name="coursegrade"]').text(),
				'coursedesc' : _that.parent().parent().find('td[data-name="coursedesc"]').text(),
			}
			$("#modifyCourse-coursename").val(data.coursename).focus().attr('data-id', data.courseid);
			$("#modifyCourse-coursegrade").val(data.coursegrade);
			$("#modifyCourse-coursedesc").val(data.coursedesc);
		});
	});

	/*修改弹出框的确定按钮*/
	$("#modifyCourseBtn").click(function() {
		var url = CONST.modifyCourse;
		var data = {
			'courseid'     : $("#modifyCourse-coursename").attr('data-id'),
			'coursename'   : $("#modifyCourse-coursename").val(),
			'coursegrade'  : $("#modifyCourse-coursegrade").val(),
			'coursedesc'   : $("#modifyCourse-coursedesc").val(),
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