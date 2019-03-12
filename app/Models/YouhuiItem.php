<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  YouhuiItem extends Model {
        
    public $timestamps = false;

    public static function GetItem ($id) {
        $youhuiItem = YouhuiItem::where("id", $id)->first();
        if ($youhuiItem) {
            return $youhuiItem;
        }
    }
}
