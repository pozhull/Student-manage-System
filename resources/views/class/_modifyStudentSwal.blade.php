<!-- 创建学生弹出框start -->
<div class="container modal fade" id="modifyStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content form-signin">
        <!-- 头部 -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">修改学生</h4>
        </div>

        <!-- 中间按钮组 -->
        <div class="modal-body">
                <!-- 警告框 -->
                <div class="alert alert-danger alert-dismissible " id="modifyStu-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Warning!</strong> 
                    <span id="modifyStu-warning-msg"></span>
                </div>

                <!-- 班级年级 -->
                <div class="row form-group"  id="">
                    <!-- 年级 -->
                    <div class="col-lg-6">
                        <div class="input-group input-group-md">   
                            <span class="input-group-addon glyphicon">年级</span>
                            <select name="" id="modifyStu-gradeSel" class="form-control">
                                <option value="0">请选择</option>
                                <option value="10">高一</option>
                                <option value="11">高二</option>
                                <option value="12">高三</option>
                            </select>
                        </div>
                    </div>
                    <!-- 班级 -->
                    <div class="col-lg-6">
                        <div class="input-group input-group-md">  
                            <span class="input-group-addon glyphicon" 
                            style="">班级</span>
                            <select name="" id="modifyStu-classSel" class="form-control">
                                <option value="0">请选择</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 学号&姓名 -->
                <div class="row form-group"  id="">
                    <!-- 学号 -->
                    <div class="col-lg-6">
                        <div class="input-group">   
                            <div class="input-group-addon glyphicon"> 学号 </div>
                            <label for="resetUsername" class="sr-only">请输入学号</label>
                            <input type="number"  class="form-control" id="modifyStu-studentIdInp" placeholder="请输入学号" required="" >
                        </div>
                    </div>
                    <!-- 姓名 -->
                    <div class="col-lg-6">
                        <div class="input-group">   
                            <div class="input-group-addon glyphicon">姓名</div>
                            <label for="resetUsername" class="sr-only">请输入姓名</label>
                            <input type="text"  class="form-control" id="modifyStu-nameInp" placeholder="请输入姓名" required="" >
                        </div>
                    </div>
                </div>


                <!-- 身份证号 -->
                <div class="form-group"  id="">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon">身份证号</div>
                        <label for="resetUsername" class="sr-only">请输入身份证号</label>
                        <input type="text"  class="form-control" id="modifyStu-identifyInp" placeholder="请输入身份证号" required="" >
                    </div>
                </div>

                <!-- 性别 -->
                <div class="row form-group"  id="">
                    <div class="col-lg-6">
                        <div class="input-group" style="height: 44px;" >   
                            <div class="input-group-addon glyphicon" style="height:31px;border-right: 1px solid #ccc;padding: 6px 26px;">性别</div>
                            <label class="radio-inline" style="line-height: 44px;margin-left: 30px;margin-right: 40px;">
                                <input type="radio" name="modifyStu-sexInp" id="" value="男" style="height: 38px;" checked> 男
                            </label>
                            <label class="radio-inline" style="line-height: 44px;">
                                <input type="radio" name="modifyStu-sexInp" id="" value="女" style="height: 38px;"> 女
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">   
                            <div class="input-group-addon glyphicon" >年龄</div>
                            <label for="resetUsername" class="sr-only">请输入年龄</label>
                            <input type="number"  class="form-control" id="modifyStu-ageInp" placeholder="请输入年龄" required="" min="0">
                        </div>
                    </div>
                </div>

                 <!-- 入学时间 -->
                <div class="form-group"  id="">
                    <div class="input-group">   
                        <div class="input-group-addon glyphicon">入学时间</div>
                        <label for="resetUsername" class="sr-only">请输入入学时间</label>
                        <input type="date"  class="form-control" id="modifyStu-entranceDateInp" placeholder="请输入入学时间" value="2014-09-01" required="" style="line-height: 22.8px;">
                    </div>
                </div>
        </div>

        <!-- 尾部确定按钮 -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary" id="modifyStuBtn" >确定</button>
        </div>
      <!-- </form> -->
    </div>
  </div>
</div>
<!-- 创建学生弹出框end