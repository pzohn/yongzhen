<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Libs\GuzzleHttp;

class UserController extends Controller
{
    public function getUser(Request $req) {
        $id = $req->get('id');
        $user = User::getUser($id);
        return $user;
    }

    public function LoginWx(Request $req) {
        $urlLogin = "https://api.weixin.qq.com/sns/jscode2session";
        $paramsLogin = [
        	'appid' => "wx544372e10f473fcb",
            'secret' => "98b78beecfa63eafd0b614e6deee10e5",
            'js_code' => $req->get('js_code'),
            'grant_type' => "authorization_code",
        ];
        try {
            $resultLogin = GuzzleHttp::guzzleGet($urlLogin, $paramsLogin);
            if (isset($resultLogin['errcode'])) {
                return [
                    "errcode" => $resultLogin['errcode'],
                    "errmsg" => "无效登录信息",
                ];
            }

            return $resultLogin;

        } catch (\Exception $e) {
            // 异常处理
            \Log::info("----------", [$e]);
            return [
                "code" => $e->getCode(),
                "msg"  => $e->getMessage(),
                "data" => [],
            ];
        }
    }
}