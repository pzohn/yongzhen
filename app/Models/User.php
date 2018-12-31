<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  User extends Model {
        
    public $timestamps = false;

    public static function GetUser($id) {
        $user = Trade::where("id", $id)->first();
        if ($user) {
            return $user;
        }
    }
}