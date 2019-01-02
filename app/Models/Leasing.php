<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Leasing extends Model {
        
    public $timestamps = false;

    public static function GetLeasing($id) {
        $leasing = Leasing::where("id", $id)->first();
        if ($leasing) {
            return $leasing;
        }
    }
}
