<!-- 创建学生弹出框start -->
<div class="container modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content form-signin">
      <!-- <form class="form-signin" name="resetForm" id="resetForm" method="post" method="{{url('login/resetPwd')}}"> -->

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">添加课程</h4>
        </div>

        <div class="modal-body">
            <!-- 警告框 -->
            <div class="alert alert-danger alert-dismissible hidden" id="createCourse-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Warning!</strong> 
                <span id="createCourse-warning-msg"></span>
            </div>

            <!-- 课程名字 -->
            <div class="form-group"  id="">
                <div class="input-group">   
                    <div class="input-group-addon glyphicon" > 课程名字 </div>
                    <label for="resetUsername" class="sr-only">请输入课程名字</label>
                    <input type="text"  class="form-control" id="createCourse-coursename" placeholder="请输入课程名字" required="" >
                </div>
            </div>

            <!-- 课程总分 -->
            <div class="form-group"  id="">
                <div class="input-group">   
                    <div class="input-group-addon glyphicon" > 课程总分 </div>
                    <label for="resetUsername" class="sr-only">请输入课程总分</label>
                    <input type="number"  class="form-control" id="createCourse-coursegrade" placeholder="请输入课程总分" required="" >
                </div>
            </div>

            <!-- 课程备注 -->
            <div class="form-group"  id="">
                <div class="input-group">   
                    <div class="input-group-addon glyphicon" > 课程备注 </div>
                    <label for="resetUsername" class="sr-only">请输入课程备注</label>
                    <textarea type="text"  class="form-control" id="createCourse-coursedesc" placeholder="请输入课程备注" required="" rows="3"></textarea>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary" id="createCourseBtn" >确定</button>
        </div>
      <!-- </form> -->
    </div>
  </div>
</div>
<!-- 创建学生弹出框end -->