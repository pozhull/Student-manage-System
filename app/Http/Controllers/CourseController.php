<?php
namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        $courses = Course::all();
        $path = array(
            "verifyCodePath" => action('LoginController@verifyCode'),
            "resetPwd" => action('LoginController@resetPwd'),
            "modifyPwd" => action('LoginController@modifyPwd'),
            "deleteCourse" => action('CourseController@deleteCourse'),
            "createCourse" => action('CourseController@createCourse'),
            "modifyCourse" => action('CourseController@modifyCourse'),
        );

        session_start();
        $username = $_SESSION['username'];
        return view('course.index', [
            'username'  =>   $username,
            'path'      =>   $path,
            'courses'   =>   $courses,
        ]);
    }
    /*删除课程*/
    public function deleteCourse(Request $request) {
        $data = array(
            'status'  =>  'error',
        );  //返回数据

        if ($request->isMethod('POST')) {
            $courseid = $request->get('courseid');
            if (Course::where('courseid', $courseid)->delete()) {
                $data = array(
                    'status'  =>  'success',
                );  //返回数据
            }
        }
        return response()->json($data);
    }

    /*创建课程*/
    public function createCourse(Request $request) {
        $data = array(
            'status'  =>  'error',
        );  //返回数据

        if ($request->isMethod('POST')) {
            $courseid = Course::all()->max('courseid')+1;
            $coursename = $request->get('coursename');
            $coursegrade = $request->get('coursegrade');
            $coursedesc = $request->get('coursedesc');

            $Course = new Course;
            $Course->courseid = $courseid;
            $Course->coursename = $coursename;
            $Course->coursegrade = $coursegrade;
            $Course->coursedesc = $coursedesc;


            if ($Course->save()){
                $data = array(
                    'status'  =>  'success',
                );  //返回数据
            }
        }

        return response()->json($data);
    }

    /*修改课程*/
    public function modifyCourse(Request $request) {
        $data = array(
            'status'  =>  'error',
        );  //返回数据

        if ($request->isMethod('POST')) {
            $courseid = $request->get('courseid');
            $coursename = $request->get('coursename');
            $coursegrade = $request->get('coursegrade');
            $coursedesc = $request->get('coursedesc');
            if (Course::where('courseid', $courseid)->update([
                'coursename' => $coursename,
                'coursegrade' => $coursegrade,
                'coursedesc' => $coursedesc,
            ])) {
                $data = array(
                    'status'  =>  'success',
                );  //返回数据
            }
        }
        return response()->json($data);
    }

}
?>