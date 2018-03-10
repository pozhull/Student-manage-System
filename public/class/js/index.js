$(function() {
	/*删除班级*/
	$(".course-del-btn").click(function() {
		var url = CONST.deleteClass;
		var classid = $(this).attr('data-id');
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
				'class' : classid,
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

	/*班级详情*/
	$(".detailClass").click(function() {
		var classid = $(this).attr('data-id');
		var gradeVal = parseInt(classid / 100);
		var classVal = parseInt(classid % 100);
		console.log(classid);
		console.log('grade:' + gradeVal + '--class:' + classVal);
		location.href = CONST.detailClass + "?grade="
				+ gradeVal + "&class=" + classVal;
	})
})