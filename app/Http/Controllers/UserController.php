<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Good;
use App\Models\City;

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
        $iscollect = $this->iscollect($req);
        if ($iscollect == $collect_flag)
            return $iscollect;
        $collect_ids = User::GetUser($login_id)->collect_ids;
        $collect_idsTmp = "";
        if ($collect_flag){
            if ($collect_ids == ""){
                $collect_idsTmp = strval($detail_id);
            }else{
                $collect_idsTmp = $collect_ids . "@" . strval($detail_id);
            }
        }else{
            if (strpos($collect_ids, '@') !== false){
                $arry = preg_split("/@/",$collect_ids);
                $arryTmp = [];
                foreach ($arry as $k => $v) {
                    $id = intval($v);
                    if ($id != $detail_id){
                        $arryTmp[] = $v;
                    }
                    $collect_idsTmp = implode("@",$arryTmp);
                }
            }else{
                $collect_idsTmp = "";
            }
        }
        User::CollectUpdate($login_id,$collect_idsTmp);
        return $this->iscollect($req);
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
        if (strpos($collect_ids, '@') !== false){
            $arry = preg_split("/@/",$collect_ids);
            $flag = false;
            foreach ($arry as $k => $v) {
                $id = intval($v);
                if ($id == $detail_id){
                    $flag = true;
                }
            }
            if ($flag){
                return 1;
            }else{
                return 0;
            }
        }else{
            $id = intval($collect_ids);
            if ($id == $detail_id){
                return 1;
            }else{
                return 0;
            }
        }
    }

    public function getCollect(Request $req) {
        $login_id = $req->get('login_id');
        $user = User::GetUser($login_id);
        if (!$user)
            return 0;
        $collect_ids = $user->collect_ids;
        if ($collect_ids == "")
            return 0;
        $pos = strpos($collect_ids, '@');
        if ($pos == false){
            $id = intval($collect_ids);
            $good = Good::GetGood($id);
            $goods = [
                "id" => $good->id,
                "name" => $good->name,
                "company" => $good->company,
                "city" => City::GetCity($good->city_id),
                "price_day" => $good->price_day,
                "price_month" => $good->price_month,
                "product_pic" => $good->product_pic
            ];
            return [
                "count" => $count,
                "goods" => $goods
            ];
        }else{
            $arry = preg_split("/@/",$collect_ids);
            $goods = [];
            foreach ($goods as $k => $v) {
                $id = intval($v);
                $good = Good::GetGood($id);
                $goods[] = [
                    "id" => $good->id,
                    "name" => $good->name,
                    "company" => $good->company,
                    "city" => City::GetCity($good->city_id),
                    "price_day" => $good->price_day,
                    "price_month" => $good->price_month,
                    "product_pic" => $good->product_pic
                ];
            }
            return [
                "count" => count($arry),
                "goods" => $goods
            ];
        }
    }
}