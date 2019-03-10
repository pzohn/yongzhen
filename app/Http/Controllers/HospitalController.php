<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospitaltype;
use App\Models\City;
use App\Models\Hospital;


class HospitalController extends Controller
{
    public function getTypes() {
        $hospitaltypes = Hospitaltype::GetTypes();
        return $hospitaltypes;
    }

    public function getCities() {
        $cities = City::GetCities();
        return $cities;
    }

    public function getHospitalsByCity(Request $req) {
        $city = $req->get('city');
        $hospitals = Hospital::GetHospitalsByCity($city);
        $hospitalsTmp = [];
        foreach ($hospitals as $k => $v) {
            $hospitalsTmp[] = [
            "id" => $v->id,
            "title" => $v->title,
	        "img" => $v->img,
            "city" => $v->city,
            "level" => $v->level,
            "type" => $v->type,
            "desc" => $v->desc
            ];
        }
        return [
            "count" => $count,
            "hospitals" => $hospitalsTmp
        ];
    }
}
