<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Good;
use App\Models\City;

class GoodController extends Controller
{
    public function getGood() {
        $good = Good::GetGood();
        $count = Good::GetGoodCount();
        return [
            "count" => $count,
            "good" => $good
        ];
    }

    public function getGoodByType(Request $req) {
        $type_id = $req->get('type_id');
        $good = Good::GetGoodByType($type_id);
        $count = Good::GetGoodCountByType($type_id);
        $goodTmp = [
            "name" => $good->name,
            "company" => $good->company,
            "city" => City::GetCity($good->city_id),
            "price_day" => $good->price_day,
            "price_month" => $good->price_month
        ];
        return [
            "count" => $count,
            "good" => $goodTmp
        ];
    }
}