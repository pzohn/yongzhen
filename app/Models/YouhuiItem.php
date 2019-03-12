<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Youhuiitem extends Model {
        
    public $timestamps = false;

    public static function GetItem ($id) {
        $youhuiitem = Youhuiitem::where("id", $id)->first();
        if ($youhuiitem) {
            return $youhuiitem;
        }
    }
}
