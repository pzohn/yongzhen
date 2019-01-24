<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Uploadpic extends Model {
        
    public $timestamps = false;

    public static function GetPics($parent_id) {
        $pics = Uploadpic::where("parent_id", $parent_id)->get();
        if ($pics) {
            return $pics;
        }
    }

    public static function InsertPic($params) {
        $uploadpic = new self;
        $uploadpic->url = array_get($params,"url");
        $uploadpic->parent_id = array_get($params,"parent_id");
        $uploadpic->save();
        return $uploadpic;
    }
}