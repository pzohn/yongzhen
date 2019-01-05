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

    public static function GetGoodsByType($typeid) {
        $goods = Good::where("type_id", $typeid)->get();
        if ($goods) {
            return $goods;
        }
    }

    public static function GetGoods() {
        $goods = Good::get();
        if ($goods) {
            return $goods;
        }
    }

    public static function GetGoodsCount() {
        $count = Good::get()->count();
        return $count;
    }

    public static function GetGoodsCountByType($typeid) {
        $count = Good::where("type_id", $typeid)->get()->count();
        return $count;
    }

    public static function GetGood($id) {
        $good = Good::where("id", $id)->first();
        if ($good) {
            return $good;
        }
    }

    public static function GetGoodsByName($name) {
        $goods = Good::where('name','like', '%'.$name.'%')->get();
        if ($goods) {
            return $goods;
        }
    }

    public static function GetGoodsCountByName($name) {
        $count = Good::where('name','like', '%'.$name.'%')->get()->count();
        return $count;
    }
}