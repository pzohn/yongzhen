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
        $user = Trade::where("id", $id)->first();
        if ($user) {
            $user->collect_ids = $collect_ids;
            $user->update();
            return $user;
        }
    }
}