<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Good;
use App\Models\City;
use App\Models\Address;

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
                "count" => 1,
                "goods" => $goods
            ];
        }else{
            $arry = preg_split("/@/",$collect_ids);
            $goods = [];
            foreach ($arry as $k => $v) {
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

    public function getAddresses(Request $req) {
        $login_id = $req->get('login_id');
        $user = User::GetUser($login_id);
        if (!$user)
            return 0;
        $address_ids = $user->address_ids;
        if ($address_ids == "")
            return 0;
        $address_defult_id = $user->address_defult_id;
        $pos = strpos($address_ids, '@');
        if ($pos == false){
            $id = intval($address_ids);
            $address = Address::GetAddress($id);
            $addresses = [
                "id" => $address->id,
                "name" => $address->name,
                "phone" => $address->phone,
                "province" => $address->province,
                "city" => $address->city,
                "area" => $address->area,
                "detail" => $address->detail
            ];
            return [
                "count" => 1,
                "address_defult_id" => $address_defult_id,
                "addresses" => $addresses
            ];
        }else{
            $arry = preg_split("/@/",$address_ids);
            $addresses = [];
            foreach ($arry as $k => $v) {
                $id = intval($v);
                $address = Address::GetAddress($id);
                $addresses[] = [
                    "id" => $address->id,
                    "name" => $address->name,
                    "phone" => $address->phone,
                    "province" => $address->province,
                    "city" => $address->city,
                    "area" => $address->area,
                    "detail" => $address->detail
                ];
            }
            return [
                "count" => count($arry),
                "address_defult_id" => $address_defult_id,
                "addresses" => $addresses
            ];
        }
    }

    public function updateAddress(Request $req) {
        $params = [
            "id" => $req->get('id'),
            "name" => $req->get('name'),
            "phone" => $req->get('phone'),
            "province" => $req->get('province'),
            "city" => $req->get('city'),
            "area" => $req->get('area'),
            "detail" => $req->get('detail')
        ]; 
        $address = Address::addressUpdate($params);
        return $address;
    }

    public function insertAddress(Request $req) {
        $params = [
            "name" => $req->get('name'),
            "phone" => $req->get('phone'),
            "province" => $req->get('province'),
            "city" => $req->get('city'),
            "area" => $req->get('area'),
            "detail" => $req->get('detail'),
            "login_id" => $req->get('login_id')
        ]; 
        $address = Address::addressInsert($params);
        $id = $address->id;
        $login_id = $address->login_id;
        
        $address_ids = User::GetUser($login_id)->address_ids;
        $address_idsTmp = "";
        if ($address_ids == ""){
            $address_idsTmp = strval($id);
            User::AddressDefaultUpdate($login_id,$id);
        }else{
            if (strpos($address_ids, '@') !== false){
                $arry = preg_split("/@/",$address_ids);
                $b = false;
                foreach ($arry as $k => $v) {
                    $idtmp = intval($v);
                    if ($idtmp == $id){
                        $b = true;
                        break;
                    }
                    if ($b == false){
                        $address_idsTmp = $address_ids . "@" . strval($id);
                    }
                }
            }else{
                $address_idsTmp = $address_ids . "@" . strval($id);
            }
        }
        User::AddressUpdate($login_id,$address_idsTmp);
        if ($req->get('default_flag') == true){
            User::AddressDefaultUpdate($login_id,$id);
        }
    }

    public function delAddress(Request $req) {
        $id = $req->get('id');
        $login_id = $req->get('login_id');
        Address::addressDel($id);

        $address_ids = User::GetUser($login_id)->address_ids;
        $address_idsTmp = "";
        if ($address_ids != ""){
            if (strpos($address_ids, '@') !== false){
                $arry = preg_split("/@/",$address_ids);
                $arryTmp = [];
                foreach ($arry as $k => $v) {
                    $idtmp = intval($v);
                    if ($idtmp != $id){
                        $arryTmp[] = $v;
                    }
                    $address_idsTmp = implode("@",$arryTmp);
                }
            }else if (intval($address_ids == $id)){
                $address_idsTmp = "";
            }
        }
        $user = User::AddressUpdate($login_id,$address_idsTmp);
        if ($user->address_defult_id == $id){
            $user = User::AddressDefaultUpdate($login_id,0);
            return $user;
        }
    }

    public function getAddress(Request $req) {
        $id = $req->get('id');
        $address = Address::GetAddress($id);
        return $address;
    }

    public function updateDefaultAddress(Request $req) {
        $id = $req->get('id');
        $login_id = $req->get('login_id');
        $user = User::AddressDefaultUpdate($login_id,$id);
        return $user;
    }
}