<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  User extends Model {
        
    public $timestamps = false;

    public static function GetUser($id) {
        $user = User::where("id", $id)->first();
        if ($user) {
            return $user;
        }
    }

    public static function UserLogin($phone,$passwd) {
        $user = User::where("phone", $phone)->first();
        if (!$user) {
            return 0;
        }
        $user = User::where("phone", $phone)->where("passwd", $passwd)->first();
        if (!$user) {
            return 1;
        }
        return $user;
    }

    public static function UserInsert($params) {
        $user = new self;
        $user->name = array_get($params,"name");
        $user->address = array_get($params,"address");
        $user->phone = array_get($params,"phone");
        $user->passwd = array_get($params,"passwd");
        $user->age = array_get($params,"age");
        $user->sex = array_get($params,"sex");
        $user->save();
        return $user;
    }

    public static function CollectUpdate($id,$collect_ids) {
        $user = User::where("id", $id)->first();
        if ($user) {
            $user->collect_ids = $collect_ids;
            $user->update();
            return $user;
        }
    }

    public static function AddressUpdate($id,$address_ids) {
        $user = User::where("id", $id)->first();
        if ($user) {
            $user->address_ids = $address_ids;
            $user->update();
            return $user;
        }
    }

    public static function AddressDefaultUpdate($id,$address_defult_id) {
        $user = User::where("id", $id)->first();
        if ($user) {
            $user->address_defult_id = $address_defult_id;
            $user->update();
            return $user;
        }
    }

    public static function SaveUser($params) {
        $user = User::where("id", array_get($params,"id"))->first();
        if ($user) {
            $user->name = array_get($params,"name");
            $user->age = array_get($params,"age");
            $user->address = array_get($params,"address");
            $user->update();
            return $user;
        }
    }
}