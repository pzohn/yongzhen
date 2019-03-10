<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Hospital extends Model {
        
    public $timestamps = false;

    public static function GetHospitalsByCity($city) {
        $hospitals = Hospital::where("city", $city)->get();
        if ($hospitals) {
            return $hospitals;
        }
    }
}