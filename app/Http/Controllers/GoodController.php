<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Good;
use App\Models\City;
use App\Models\Leasing;
use App\Models\Show;

class GoodController extends Controller
{
    public function getGoods() {
        $goods = Good::GetGood();
        $count = Good::GetGoodCount();
        return [
            "count" => $count,
            "goods" => $goods
        ];
    }

    public function getGoodsByType(Request $req) {
        $type_id = $req->get('type_id');
        $goods = Good::GetGoodsByType($type_id);
        $count = Good::GetGoodsCountByType($type_id);
        $goodsTmp = [];
        foreach ($goods as $k => $v) {
            $goodsTmp[] = [
            "id" => $v->id,
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

    public function getGood(Request $req) {
        $id = $req->get('id');
        $good = Good::GetGood($id);
        $leasing_ids = $good->leasing_ids;
        $pos = strpos($leasing_ids, '@');
        $goodTmp =[
            "name" => $good->name,
            "brand" => $good->brand,
            "register" => $good->register,
            "number" => $good->number,
            "product" => $good->product,
            "use" => $good->use,
            "product_pic" => $good->product_pic,
            "detail_pic" => $good->detail_pic,
            "price" => $good->price,
            "price_day" => $good->price_day,
            "price_month" => $good->price_month,
            "leasing_pos" => $pos,
            "leasing_first" => $this->getLeasingFirst($leasing_ids),
            "leasings" => $leasing_ids
        ];
        return $goodTmp;
    }

    public function getLeasingFirst($leasing_ids) {
        $pos = strpos($leasing_ids, '@');
        if ($pos == false){
            $leasing = Leasing::GetLeasing($leasing_ids);
            if ($leasing){
                return $leasing;
            }
        }else{
            $arry = preg_split("/@/",$leasing_ids);
            $leasing = Leasing::GetLeasing($arry[0]);
            if ($leasing){
                return $leasing;
            }
        }
    }

    public function getLeasings(Request $req) {
        $leasing_ids = $req->get('leasing_ids');
        $pos = strpos($leasing_ids, '@');
        if ($pos == false){
            $leasing = Leasing::GetLeasing($leasing_ids);
            return [
                "count" => 1,
                "leasings" => $leasing
            ];

        }else{
            $arry = preg_split("/@/",$leasing_ids);
            $leasing = [];
            foreach ($arry as $v) {
                $leasing[] = [
                    "leasing" => Leasing::GetLeasing($v)
                ];
            }
            return [
                "count" => count($arry),
                "leasings" => $leasing
            ];
        }
    }

    public function getLeasing(Request $req) {
        $id = $req->get('id');
        $leasing = Leasing::GetLeasing($id);
        return $leasing;
    }

    public function getShows() {
        $good_shows = Show::GetShows(1);
        $good_count = Show::GetShowsCount(1);
        $good_showsmp = [];
        foreach ($good_shows as $k => $v) {
            $good_showsmp[] = [
            "id" => $v->good_id,
            "name" => Good::GetGood($v->good_id)->name,
	        "product_pic" => Good::GetGood($v->good_id)->product_pic,
            "price_day" => Good::GetGood($v->good_id)->price_day
            ];
        }
        $hot_shows = Show::GetShows(2);
        $hot_count = Show::GetShowsCount(2);
        $hot_showsmp = [];
        foreach ($hot_shows as $k => $v) {
            $hot_showsmp[] = [
            "id" => $v->good_id,
            "name" => Good::GetGood($v->good_id)->name,
	        "product_pic" => Good::GetGood($v->good_id)->product_pic,
            "price_day" => Good::GetGood($v->good_id)->price_day
            ];
        }
        return [
            "good_count" => $good_count,
            "good_shows" => $good_showsmp,
            "hot_count" => $hot_count,
            "hot_shows" => $hot_showsmp
        ];
    }

    public function getGoodsByName(Request $req) {
        $name = $req->get('name');
        $goods = Good::GetGoodsByName($name);
        $count = Good::GetGoodsCountByName($name);
        $goodsTmp = [];
        foreach ($goods as $k => $v) {
            $goodsTmp[] = [
            "id" => $v->id,
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
