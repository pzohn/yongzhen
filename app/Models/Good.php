<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Good extends Model {
        
    public $timestamps = false;

    public static function GetGoodById($id) {
        $good = Good::where("id", $id)->first();
        if ($good) {
            return $good;
        }
    }

    public static function GetGoodByType($typeid) {
        $good = Good::where("type_id", $typeid)->get();
        if ($good) {
            return $good;
        }
    }

    public static function GetGood() {
        $good = Good::get();
        if ($good) {
            return $good;
        }
    }

    public static function GetGoodCount() {
        $count = Good::get()->count();
        return $count;
    }
}