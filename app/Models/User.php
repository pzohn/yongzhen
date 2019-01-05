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
}