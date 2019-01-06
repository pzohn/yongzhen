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

    public function login(Request $req) {
        $phone = $req->get('phone');
        $passwd = $req->get('passwd');
        $user = User::UserLogin($phone,$passwd);
        return $user;
    }

    public function registor(Request $req) {
        $user = User::UserInsert($req);
        return $user;
    }

    public function collect(Request $req) {
        $collect_flag = $req->get('collect_flag');
        $login_id = $req->get('login_id');
        $detail_id = $req->get('detail_id');
        $collect_ids = User::GetUser($login_id)->collect_ids;
        $collect_idsTmp = "";
        if ($collect_flag){
            if ($collect_ids == ""){
                $collect_idsTmp = strval($detail_id);
            }else{
                $collect_idsTmp = $collect_ids . "@" . strval($detail_id);
            }
        }else{
            if (strpos($collect_ids, '@')){
                $arry = preg_split("/@/",$collect_ids);
                $arryTmp = [];
                foreach ($arry as $k => $v) {
                    $id = intval($v);
                    if ($id != $detail_id){
                        $arryTmp[] = $v;
                    }
                    $collect_idsTmp = implode("@",$arryTmp);
                }
                $collect_idsTmp = strval($detail_id);
            }else{
                $collect_idsTmp = "";
            }
        }
        return User::CollectUpdate($login_id,$collect_idsTmp);
    }

    public function iscollect(Request $req) {
        $login_id = $req->get('login_id');
        $detail_id = $req->get('detail_id');
        $user = User::GetUser($login_id);
        if (!$user)
            return 0;
        $collect_ids = $user->collect_ids;
        if ($collect_ids == "")
            return 0;
        $detail_id_str = strval($detail_id);
        $pos = strpos($collect_ids, $detail_id_str);
        if ($pos !== false)
            return 1;
        else
            return 0;
    }
}