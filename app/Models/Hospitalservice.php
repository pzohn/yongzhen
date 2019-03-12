<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Hospitalservice extends Model {
        
    public $timestamps = false;

    public static function GetHospitalserviceByType($type) {
        $hospitalservices = Hospitalservice::where("type", $type)->get();
        if ($hospitalservices) {
            return $hospitalservices;
        }
    }
}