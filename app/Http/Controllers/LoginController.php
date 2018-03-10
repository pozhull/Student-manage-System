<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    /*登录页面*/
    public function index(Request $request) {

    	$error = array();
		$data = array(
			"username" => "",
			"password" => "",
			"verifyCode" => "",
			"type" => "",
		);
		$path = array(
            "verifyCodePath" => action('LoginController@verifyCode'),
            "resetPwd" => action('LoginController@resetPwd'),
            "modifyPwd" => action('LoginController@modifyPwd'),
        );

    	if ($request->isMethod('POST')) {
    		$username = $request->get('username');
            $password = $request->get('password');
            $verifyCode = $request->get('verifyCode');
            $type = $request->get('type');


    		session_start();
    		if ($verifyCode != $_SESSION['verifyCode']) {
    			$error = array("verifyCodeError", "验证码错误");
    			$data["username"] = $username;
    			$data["password"] = $password;
    			$data["type"] = $type;
    			// $error = json_encode($error);
    		} else {
                $data["username"] = $username;
    			$query_data = Login::where([
    			    'username'  => $username,
    			    'password'  => $password,
    			    'type'      => $type,
                ])->first();
                if (count($query_data) == 0) {
                    $error = array("userError", "学号或密码错误");
                } else if (count($query_data) == 1) {
                    $_SESSION['username'] = $username;
                    return redirect("account/index");
                }
    		}
    	}

        return view('login.index', [
        	"path"          => $path,
        	"error"         => $error,
        	"data"          => $data,
        ]);
    }

    /*登录页面：验证码*/
	public function verifyCode() {

		session_start();

		$img_w = 100;    //图片宽度
		$img_h = 40;     //图片高度
		$code_len = 4;   //验证码长度

		$image = imagecreatetruecolor($img_w, $img_h);        //利用php的gd创建图片
		$bgcolor = imagecolorallocate($image, 235, 235, 235);   //背景颜色
		imagefill($image, 0, 0, $bgcolor);

		$fontsize = 16;
		$angle = 0;
		$fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));
		$fontfile = public_path("common/font/arial.ttf");
		$captch_code = '';

		// 数字+字母
		for ($i = 0; $i < $code_len; $i++) {
			$data = 'abcdefghijklmnopqrstuvwxyz123456789';
			$fontcontent = substr($data, rand(0, strlen($data)-1), 1);
			$captch_code .= $fontcontent;

			$x = ($i*100/4) + rand(5, 10);
			$y = rand(20, 30);

			// imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
			imagettftext($image, $fontsize, $angle, $x, $y, $fontcolor,  $fontfile, $fontcontent);
		}

		$_SESSION['verifyCode'] = $captch_code;

		// 干扰元素：点	
		for ($i = 0; $i < 200; $i++) {
			$pointcolor = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));
			imagesetpixel($image, rand(1, $img_w-1), rand(1, $img_h-1), $pointcolor);
		}

		// 干扰元素：线
		for ($i=0; $i < 3; $i++) { 
			$linecolor = imagecolorallocate($image, rand(80, 220), rand(80, 220), rand(80, 220));
			imageline($image, rand(1, $img_w-1), rand(1, $img_h-1), rand(1, $img_w-1), rand(1, $img_h-1), $linecolor);
		}

		header('content-type:image/png');
		imagepng($image);


		// end 
		imagedestroy($image);
    }

    /*登录页面：找回密码*/
    public function resetPwd(Request $request) {
        $data = array(
            'status'  =>  'method',
            'msg'  =>  '请求失败',
        );  //返回数据

        if ($request->isMethod('POST')) {
            $resetUsername = $request->get('resetUsername');
            $resetLicense = $request->get('resetLicense');
            $resetVerifyCode = $request->get('resetVerifyCode');

            session_start();
            //验证码错误
            if ($resetVerifyCode != $_SESSION['verifyCode']) {
                $data = array(
                    'status'  =>  'verifyCodeError',
                    'msg'  =>  '验证码错误',
                );
            } else {
                $query_data = Login::where([
                    'username'  =>   $resetUsername,
                    'license'  =>   $resetLicense,
                ])->first();
                //学号或凭据错误
                if (count($query_data) == 0) {
                    $data = array(
                        'status'  =>  'notFound',
                        'msg'  =>  '学号或凭据错误',
                    );
                } else if (count($query_data) == 1) {
                    //查找成功
                    $data = array(
                        'status'  =>  'success',
                        'msg'  =>  $query_data->password,
                    );
                }
            }
        }
        return response()->json($data);
    }

    /*公共：修改密码*/
    public function modifyPwd(Request $request) {
        $data = array(
            'status'  =>  'error',
            'msg'  =>  '修改失败',
        );  //返回数据

        if ($request->isMethod('post')) {
            $username = $request->get('username');
            $resetPwdOld = $request->get('resetPwdOld');
            $resetPwdNew = $request->get('resetPwdNew');
            $query_data = Login::where([
                'username'  =>   $username,
                'password'  =>   $resetPwdOld,
            ])->first();
            //旧密码输入错误
            if (count($query_data) == 0) {
                $data = array(
                    'status'  =>  'oldPwdError',
                    'msg'  =>  '旧密码输入错误',
                );
            } else if (count($query_data) == 1) {

                // 修改密码
                $query_data = Login::where([
                    'username'  =>   $username,
                    'password'  =>   $resetPwdOld,
                ])->update(['password' => $resetPwdNew]);

                //修改成功
                if ($query_data) {
                    $data = array(
                        'status'  =>  'success',
                        'msg'  =>  '修改成功',
                    );
                } 
            }

        }

        return response()->json($data);
    }
}
