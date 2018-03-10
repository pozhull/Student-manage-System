<!-- 创建老师账户弹出框start -->
<div class="container modal fade" id="createTeacherModal" tabindex="-1" role="dialog" aria-labelledby="createTeacherModal" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content form-signin">
          <!-- <form class="form-signin" name="resetForm" id="resetForm" method="post" method="{{url('login/resetPwd')}}"> -->

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">添加学生</h4>
            </div>

            <div class="modal-body">
                <!-- 警告框 -->
                <div class="alert alert-danger alert-dismissible hidden" id="createTea-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Warning!</strong> 
                    <span id="createTea-warning-msg"></span>
                </div>

                <!-- 账户 -->
                <div class="form-group"  id="">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon" style="padding: 6px 26px;"> 账户 </div>
                        <label for="createTea-usernameInp" class="sr-only">请输入账户</label>
                        <input type="text"  class="form-control" id="createTea-usernameInp" placeholder="请输入账户" required="" >
                    </div>
                </div>

                <!-- 密码 -->
                <div class="form-group"  id="">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon" style="padding: 6px 26px;"> 密码 </div>
                        <label for="createTea-pwdInp" class="sr-only">请输入密码</label>
                        <input type="password"  class="form-control" id="createTea-pwdInp" placeholder="请输入密码" required="" >
                    </div>
                </div>

                <!-- 重输密码 -->
                <div class="form-group"  id="">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon"> 重输密码 </div>
                        <label for="createTea-pwdTwiceInp" class="sr-only">请重输密码</label>
                        <input type="password"  class="form-control" id="createTea-pwdTwiceInp" placeholder="请重输密码" required="" >
                    </div>
                </div>

                <!-- 凭证 -->
                <div class="form-group"  id="">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon" style="padding: 6px 26px;"> 凭证 </div>
                        <label for="createTea-licenseInp" class="sr-only">请输入凭证</label>
                        <input type="password"  class="form-control" id="createTea-licenseInp" placeholder="请输入凭证" required="" >
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-primary" id="createTeaBtn" >确定</button>
            </div>
          <!-- </form> -->
        </div>
    </div>
</div>
<!-- 创建老师账户弹出框start -->