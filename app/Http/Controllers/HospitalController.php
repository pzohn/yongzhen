<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospitaltype;
use App\Models\City;
use App\Models\Hospital;
use App\Models\Hospitalservice;
use App\Models\YouhuiItem;


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
            "hospitals" => $hospitalsTmp
        ];
    }

    public function getHospitalservicesByType(Request $req) {
        $type = $req->get('type');
        $hospitalservices = Hospitalservice::GetHospitalserviceByType($type);
        $hospitalservicesTmp = [];
        foreach ($hospitalservices as $k => $v) {
            $hospitalservicesTmp[] = [
            "id" => $v->id,
            "title" => $v->title,
	        "info" => $v->info,
            "price" => $v->price,
            "oldPrice" => $v->oldPrice,
            "icon" => $v->icon,
            "image" => $v->image,
            "serviceinfo" => $v->serviceinfo,
            "buyCnt" => $v->buyCnt,
	        "tipsInfo" => $v->tipsInfo,
            "chanPinDescUrl" => $v->chanPinDescUrl,
            "serverDescUrl" => $v->serverDescUrl,
            "attentionUrl" => $v->attentionUrl,
            "youhuiItem" => $this->getYouhuiItem($v->youhuiItem),
            ];
        }
        return [
            "hospitalservices" => $hospitalservicesTmp
        ];
    }

    public function getYouhuiItem($youhuiItem) {
        $pos = strpos($youhuiItem, '@');
        if ($pos == false){
            $res = YouhuiItem::GetItem($youhuiItem);
            return [
                "info" => $res->info,
                "price" => $res->price,
                "shengPrice" => $res->shengPrice
            ];

        }else{
            $arry = preg_split("/@/",$youhuiItem);
            $youhuiItemTmp = [];
            foreach ($arry as $v) {
                $res = YouhuiItem::GetItem($v);
                $youhuiItemTmp[] = [
                    "info" => $res->info,
                    "price" => $res->price,
                    "shengPrice" => $res->shengPrice
                ];
            }
            return $youhuiItemTmp;
        }
    }
}
