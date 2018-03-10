<!-- 按钮start -->
<div class="row ">
	<div class="media"></div>
	<div class="col-lg-2 col-md-4 col-sm-6 media">
		<div class="input-group input-group-md">
			<span class="input-group-addon" 
			style="color: #fff;background-color: #337ab7;border-color: #2e6da4;">年级</span>
			<select name="" id="gradeSel" class="form-control">
				<option value="0">请选择</option>
				<option value="10" {{Request::get('grade') == 10? 'selected': '' }}>高一</option>
				<option value="11" {{Request::get('grade') == 11? 'selected': '' }}>高二</option>
				<option value="12" {{Request::get('grade') == 12? 'selected': '' }}>高三</option>
			</select>
		</div>
	</div>
	<div class="col-lg-2 col-md-4 col-sm-6 media">
		<div class="input-group input-group-md">
			<span class="input-group-addon" 
			style="color: #fff;background-color: #337ab7;border-color: #2e6da4;">班级</span>
			<select name="" id="classSel" class="form-control">
				<option value="0">请选择</option>
				<option value="1" {{Request::get('class') == 1? 'selected': '' }}>1</option>
				<option value="2" {{Request::get('class') == 2? 'selected': '' }}>2</option>
				<option value="3" {{Request::get('class') == 3? 'selected': '' }}>3</option>
				<option value="4" {{Request::get('class') == 4? 'selected': '' }}>4</option>
				<option value="5" {{Request::get('class') == 5? 'selected': '' }}>5</option>
				<option value="6" {{Request::get('class') == 6? 'selected': '' }}>6</option>
				<option value="7" {{Request::get('class') == 7? 'selected': '' }}>7</option>
				<option value="8" {{Request::get('class') == 8? 'selected': '' }}>8</option>
				<option value="9" {{Request::get('class') == 9? 'selected': '' }}>9</option>
				<option value="10" {{Request::get('class') == 10? 'selected': '' }}>10</option>
				<option value="11" {{Request::get('class') == 11? 'selected': '' }}>11</option>
				<option value="12" {{Request::get('class') == 12? 'selected': '' }}>12</option>
				<option value="13" {{Request::get('class') == 13? 'selected': '' }}>13</option>
				<option value="14" {{Request::get('class') == 14? 'selected': '' }}>14</option>
				<option value="15" {{Request::get('class') == 15? 'selected': '' }}>15</option>
				<option value="16" {{Request::get('class') == 16? 'selected': '' }}>16</option>
				<option value="17" {{Request::get('class') == 17? 'selected': '' }}>17</option>
				<option value="18" {{Request::get('class') == 18? 'selected': '' }}>18</option>
				<option value="19" {{Request::get('class') == 19? 'selected': '' }}>19</option>
				<option value="20" {{Request::get('class') == 20? 'selected': '' }}>20</option>
				<option value="21" {{Request::get('class') == 21? 'selected': '' }}>21</option>
			</select>
		</div>
	</div>
	<div class="col-lg-2 col-md-4 col-sm-6 media hidden">
		<input type="button" class="btn btn-primary form-control" name="" value="修改班级" id="classModify">
	</div>
	<div class="col-lg-2 col-md-4 col-sm-6 media ">
		<input type="button" class="btn btn-primary form-control " name="" value="确定" id="classConfirm">
	</div>
	<div class="col-lg-2 col-md-4 col-sm-6 media hidden">
		<input type="button" class="btn btn-primary form-control" name="" value="添加学生" id="createStudent"  data-toggle="modal" data-target="#createStudentModal">
	</div>
</div>
<!-- 按钮end -->

<!-- 列表start -->
<div class="table-responsive media">
  <table class="table table-striped table-hover table-responsive">
    <thead>
      <tr>
      	<th>编号</th>
        <th>班级</th>
        <th>学号</th>
        <th>姓名</th>
        <th>身份证号</th>
        <th>性别</th>
        <th>年龄</th>
        <th>入学时间</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    	@if (isset($students) && $students->count() > 0)
    		<?php $key=1?>
    		@foreach($students as $student)
				<tr>
					<td>{{$key++}}</td>
					<td>{{$student->getGrade($student->class) . $student->class%100 . '班'}}</td>
					<td>{{$student->studentId}}</td>
					<td data-name='name'>{{$student->name}}</td>
					<td data-name='identify'>{{$student->identify}}</td>
					<td data-name='sex'>{{$student->sex}}</td>
					<td data-name='age'>{{$student->age}}</td>
					<td data-name='entranceDate'>{{$student->entranceDate}}</td>
					<td>
						<a href="#" class="student-modify-btn" data-id='{{$student->studentId}}' data-toggle="modal" data-target="#modifyStudentModal">修改</a>
						<a href="#" class="student-del-btn" data-id='{{$student->studentId}}'>删除</a>
					</td>
				</tr>
			@endforeach	    	
		@else
    		<tr><td colspan="7">暂无学生</td></tr>
    	@endif
    </tbody>
  </table>
</div>
<!-- 列表end -->
