<!-- 创建学生弹出框start -->
<div class="container modal fade" id="createStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content form-signin">
      <!-- <form class="form-signin" name="resetForm" id="resetForm" method="post" method="{{url('login/resetPwd')}}"> -->

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">添加学生</h4>
        </div>

        <div class="modal-body">
                <!-- 警告框 -->
                <div class="alert alert-danger alert-dismissible hidden" id="createStu-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Warning!</strong> 
                    <span id="createStu-warning-msg"></span>
                </div>

                <!-- 学号 -->
                <div class="form-group"  id="">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon" style="padding: 6px 26px;"> 学号 </div>
                        <label for="resetUsername" class="sr-only">请输入学号</label>
                        <input type="number"  class="form-control" id="studentIdInp" placeholder="请输入学号" required="" >
                    </div>
                </div>

                <!-- 姓名 -->
                <div class="form-group"  id="">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon"  style="padding: 6px 26px;">姓名</div>
                        <label for="resetUsername" class="sr-only">请输入姓名</label>
                        <input type="text"  class="form-control" id="nameInp" placeholder="请输入姓名" required="" >
                    </div>
                </div>

                <!-- 身份证号 -->
                <div class="form-group"  id="">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon">身份证号</div>
                        <label for="resetUsername" class="sr-only">请输入身份证号</label>
                        <input type="text"  class="form-control" id="identifyInp" placeholder="请输入身份证号" required="" >
                    </div>
                </div>

                <!-- 性别 -->
                <div class="form-group"  id="">
                    <div class="input-group" style="height: 44px;" >   
                        <div class="input-group-addon glyphicon" style="border-right: 1px solid #ccc;padding: 6px 26px;">性别</div>
                        <label class="radio-inline" style="line-height: 44px;margin-left: 30px;margin-right: 40px;">
                            <input type="radio" name="sexInp" id="" value="男" style="height: 38px;" checked> 男
                        </label>
                        <label class="radio-inline" style="line-height: 44px;">
                            <input type="radio" name="sexInp" id="" value="女" style="height: 38px;"> 女
                        </label>
                    </div>
                </div>

                <!-- 年龄 -->
                <div class="form-group"  id="">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon"  style="padding: 6px 26px;">年龄</div>
                        <label for="resetUsername" class="sr-only">请输入年龄</label>
                        <input type="number"  class="form-control" id="ageInp" placeholder="请输入年龄" required="" min="0">
                    </div>
                </div>

                 <!-- 入学时间 -->
                <div class="form-group"  id="">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon">入学时间</div>
                        <label for="resetUsername" class="sr-only">请输入入学时间</label>
                        <input type="date"  class="form-control" id="entranceDateInp" placeholder="请输入入学时间" value="2014-09-01" required="" style="line-height: 22.8px;">
                    </div>
                </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary" id="createStuBtn" >确定</button>
        </div>
      <!-- </form> -->
    </div>
  </div>
</div>
<!-- 创建学生弹出框end -->