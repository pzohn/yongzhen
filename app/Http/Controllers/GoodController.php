<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Good;
use App\Models\City;
use App\Models\Leasing;

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
            "leasing" => $this->getLeasing($leasing_ids)
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
            $leasing = Leasing::GetLeasing($arry[1]);
            if ($leasing){
                return $leasing;
            }
        }
    }

    public function getLeasing($leasing_ids) {
        $pos = strpos($leasing_ids, '@');
        if ($pos == false){
            $leasing = Leasing::GetLeasing($leasing_ids);
            if ($leasing){
                return $leasing;
            }
        }else{
            $arry = preg_split("/@/",$leasing_ids);
            $leasing = [];
            foreach ($arry as $k => $v) {
                $leasing[] = [
                    Leasing::GetLeasing($v)
                ];
            }
        }
    }
}
