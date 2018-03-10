<?php
namespace App\Http\Controllers;

use Crypt;
use App\Login;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
        $accounts = Login::where(['type' => 'teacher'])->get();
//        dd($accounts);exit;
        $path = array(
            /*公共部分start*/
            "verifyCodePath" => action('LoginController@verifyCode'),
            "resetPwd" => action('LoginController@resetPwd'),
            "modifyPwd" => action('LoginController@modifyPwd'),
            /*公共部分end*/
            "deleteAccount" => action('AccountController@deleteAccount'),
            "createTeacher" => action('AccountController@createTeacher'),
            "getSingleTea" => action('AccountController@getSingleTea'),
            "modifyTeacher" => action('AccountController@modifyTeacher'),
        );
        session_start();
        $username = $_SESSION['username'];
        return view('account.index', [
            'username'  =>   $username,
            'path'      =>   $path,
            'accounts'      =>   $accounts,
        ]);
    }

    /*删除学生和老师账户*/
    public function deleteAccount(Request $request) {
        $data = array(
            'status'  =>  'error',
        );  //返回数据

        if ($request->isMethod('POST')) {
            $id = $request->get('id');
            if (Login::where('id', $id)->delete()) {
                $data = array(
                    'status'  =>  'success',
                );  //返回数据
            }
        }
        return response()->json($data);
    }

    /*新建一个老师账户*/
    public function createTeacher(Request $request) {
        $data = array(
            'status'  =>  'error',
        );  //返回数据

        if ($request->isMethod('POST')) {

            $teacher = new Login;
            $teacher->username = $request->get('username');
            $teacher->password = $request->get('password');
            $teacher->license = $request->get('license');
            $teacher->type = 'teacher';

            if (Login::where('username', $request->get('username'))->get()->count() > 0 ) {
                $data = array(
                    'status' => 'accountExist',
                );
            } else if ($teacher->save()){
                $data = array(
                    'status'  =>  'success',
                );  //返回数据
            }
        }

        return response()->json($data);

    }

    /*根据username获取该用户的信息*/
    public function getSingleTea(Request $request) {
            $singleTeacher = array([
                'status' => 'success',
            ]);
        if ($request->isMethod('POST')) {
            $username = $request->get('username');

            $singleTeacher = Login::where(['username' => $username])
                        ->first()
                        ->toArray();
            $singleTeacher['status'] = 'success';
        }

        return response()->json($singleTeacher);
    }

    /*修改教师信息*/
    public function modifyTeacher(Request $request) {
        $data = array(
            'status'  =>  'error',
        );  //返回数据

        if ($request->isMethod('POST')) {
            $oldusername = $request->get('oldusername');
            $newusername = $request->get('newusername');
            $password = $request->get('password');
            $license = $request->get('license');
//            echo $oldClass . $newClass; exit;
            if ($oldusername != $newusername && Login::where('username', $newusername)->get()->count() > 0 ) {
                $data = array(
                    'status' => 'accountExist',
                );
            } else {
                if (Login::where('username', $oldusername)->update([
                    'username' => $newusername,
                    'password' => $password,
                    'license' => $license,
                ])) {
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