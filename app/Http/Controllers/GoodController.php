<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Good;
use App\Models\City;

class GoodController extends Controller
{
    public function getGood() {
        $goods = Good::GetGood();
        $count = Good::GetGoodCount();
        return [
            "count" => $count,
            "goods" => $goods
        ];
    }

    public function getGoodByType(Request $req) {
        $type_id = $req->get('type_id');
        $goods = Good::GetGoodByType($type_id);
        $count = Good::GetGoodCountByType($type_id);
        $goodsTmp = [];
        foreach ($goods as $k => $v) {
            $goodsTmp[] = [
            "name" => $v->name,
            "company" => $v->company,
            "city" => City::GetCity($v->city_id),
            "price_day" => $v->price_day,
            "price_month" => $v->price_month,
            "product_pic" => $v->product_pic
            ];
        }
        return [
            "count" => $count,
            "goods" => $goodsTmp
        ];
    }
}