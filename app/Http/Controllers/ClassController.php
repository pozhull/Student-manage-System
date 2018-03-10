<?php
namespace App\Http\Controllers;

use App\Classes;
use App\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClassController extends Controller
{

    public function index() {

        $students = Classes::all()
                    // ->orderBy('class', 'desc')
                    ->sortBy('class')
                    ->groupBy('class');
//                    ->filter(function ($value, $key) {
//                         return (int)$key > 1100;
//                     dd($students);exit;
		$path = array(
	        "verifyCodePath" => action('LoginController@verifyCode'),
	        "resetPwd" => action('LoginController@resetPwd'),
	        "modifyPwd" => action('LoginController@modifyPwd'),
            "deleteClass" => action('ClassController@deleteClass'),
	        "detailClass" => action('ClassController@createClass'),
	    );

    	session_start();
    	$username = $_SESSION['username'];

        return view('class.index', [
        	'username'  =>   $username,
        	'path'      =>   $path,
        	'students'  =>   $students,
        ]);
    }

    /*删除班级*/
    public function deleteClass(Request $request) {

        $data = array(
            'status'  =>  'error',
        );  //返回数据

    	if ($request->isMethod('POST')) {
    		$class = $request->get('class');
    		if (Classes::where('class', $class)->delete()) {
                $data = array(
                    'status'  =>  'success',
                );  //返回数据
            }
    	}
        return response()->json($data);
    }

    /*删除学生*/
    public function deleteStudent(Request $request) {

        $data = array(
            'status'  =>  'error',
        );  //返回数据

        if ($request->isMethod('POST')) {
            $studentID = $request->get('studentID');
            if (Classes::where('studentId', $studentID)->delete() &&
                Log::where('username', $studentID)->delete()) {
                $data = array(
                    'status'  =>  'success',
                );  //返回数据
            }
        }
        return response()->json($data);
    }

    /*创建班级*/
    public function createClass(Request $request) {
        session_start();
        $username = $_SESSION['username'];
        $grade = $request->get('grade');
        $class = $request->get('class');
        $students = null;
        if (isset($grade) && isset($class)) {
            $class = $class < 10 ? '0' . $class : $class;
            $classID = $grade .$class;
            $students = Classes::where('class', $classID)
                ->orderBy('studentId', 'asc')
                ->get();
        }
        $path = array(
            "verifyCodePath" => action('LoginController@verifyCode'),
            "resetPwd" => action('LoginController@resetPwd'),
            "modifyPwd" => action('LoginController@modifyPwd'),
            "deleteClass" => action('ClassController@deleteClass'),
            "modifyClass" => action('ClassController@modifyClass'),
            "deleteStudent" => action('ClassController@deleteStudent'),
            "createStudent" => action('ClassController@createStudent'),
            "modifyStudent" => action('ClassController@modifyStudent'),
        );

        return view('class.create', [
            'path'      =>   $path,
            'username'  =>   $username,
            'students'  =>   $students,
        ]);
    }

    /*修改班级*/
    public function modifyClass(Request $request) {

        $data = array(
            'status'  =>  'error',
        );  //返回数据

        if ($request->isMethod('POST')) {
            $oldClass = $request->get('classOld');
            $newClass = $request->get('classNew');
//            echo $oldClass . $newClass; exit;
            if (Classes::where('class', $newClass)->get()->count() > 0 ) {
                $data = array(
                    'status' => 'classExist',
                );
            } else {
                if ($oldClass == '000') {
                    $data = array(
                        'status'  =>  'createSuccess',
                    );  //返回数据
                } else if (Classes::where('class', $oldClass)->update(['class' => $newClass])) {
                    $data = array(
                        'status'  =>  'success',
                    );  //返回数据
                }
            }

        }
        return response()->json($data);
    }

    /*创建学生*/
    public function createStudent(Request $request) {
        $data = array(
            'status'  =>  'error',
        );  //返回数据

        if ($request->isMethod('POST')) {
            $studentId = $request->get('studentId');
            $name = $request->get('name');
            $identify = $request->get('identify');
            $sex = $request->get('sex');
            $age = $request->get('age');
            $class = $request->get('class');
            $entranceDate = $request->get('entranceDate');

            if (Classes::where('studentId', $studentId)->get()->count() > 0 ) {
                $data = array(
                    'status' => 'studentExist',
                );
            } else {
                $student = new Classes;
                $student->studentId = $studentId;
                $student->name = $name;
                $student->identify = $identify;
                $student->sex = $sex;
                $student->age = $age;
                $student->class = $class;
                $student->entranceDate = $entranceDate;

                $login = new Login;
                $login->username = $studentId;
                $login->password = substr($identify, -6);
                $login->license = $identify;
                $login->type = 'student';
                $login->class = $class;
                if ($student->save() && $login->save()){
                    $data = array(
                        'status'  =>  'success',
                    );  //返回数据
                }
            }
        }

        return response()->json($data);
    }

    /*修改学生信息*/
    public function modifyStudent(Request $request) {
        $data = array(
            'status'  =>  'error',
        );  //返回数据

        if ($request->isMethod('POST')) {
            $oldStudentId = $request->get('oldStudentId');
            $newStudentId = $request->get('newStudentId');
            $name = $request->get('name');
            $identify = $request->get('identify');
            $sex = $request->get('sex');
            $age = $request->get('age');
            $entranceDate = $request->get('entranceDate');
            $class = $request->get('class');

            //学号已存在
            if ($oldStudentId != $newStudentId && Classes::where('studentId', $newStudentId)->get()->count() > 0 ) {
                $data = array(
                    'status' => 'studentExist',
                );
            } else {
                $modifyStudent = Classes::where('studentId', $oldStudentId)
                                    ->update([
                                        'studentId' => $newStudentId,
                                        'name' => $name,
                                        'identify' => $identify,
                                        'sex' => $sex,
                                        'age' => $age,
                                        'entranceDate' => $entranceDate,
                                        'class' => $class,
                                    ]);

                if ($modifyStudent) {
                    Login::where('username', $oldStudentId)
                        ->update([
                            'username'   => $newStudentId,
                            'password'   => substr($identify, -6),
                            'license'    => $identify,
                            'class'      => $class,
                        ]);
                    $data = array(
                        'status'  =>  'success',
                    );  //返回数据
                }
            }
        }

        return response()->json($data);
    }
}
?>