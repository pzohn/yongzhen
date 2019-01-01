<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  City extends Model {
        
    public $timestamps = false;

    public static function GetCity($id) {
        $city = City::where("id", $id)->first();
        if ($city) {
            return $city->name;
        }
    }
}