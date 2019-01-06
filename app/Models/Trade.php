<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Trade extends Model {
        
    public static function payInsert($params) {

        $trade = new self;
        $trade->out_trade_no = array_get($params,"out_trade_no");
        $trade->body = array_get($params,"body");
        $trade->details = array_get($params,"details");
        $trade->total_fee = array_get($params,"total_fee");
        $trade->phone = array_get($params,"phone");
        $trade->leasing_id = array_get($params,"leasing_id");
        $trade->save();
        return $trade;
    }

    public static function payUpdate($out_trade_no) {
        $trade = Trade::where("out_trade_no", $out_trade_no)->first();
        if ($trade) {
            if($trade->pay_status == 1)
            {
                return $trade;
            }
            $trade->pay_status = 1;
            $trade->update();
            return $trade;
        }
    }

    public static function paySelect($out_trade_no) {
        $trade = Trade::where("out_trade_no", $out_trade_no)->first();
        if ($trade) {
            return $trade;
        }
    }

    public static function getTrades($phone,$type) {
        if ($type = 1){
            $trade = Trade::where("phone", $phone)->where("pay_status", 1)->get();
            return $trade;
        }
        else if ($type = 2){
            $trade = Trade::where("phone", $phone)->where("pay_status", 1)->where("get_status", 0)->get();
            return $trade;
        }
        else if ($type = 3){
            $trade = Trade::where("phone", $phone)->where("pay_status", 1)->where("get_status", 1)->where("back_status", 0)->get();
            return $trade;
        }
        else if ($type = 4){
            $trade = Trade::where("phone", $phone)->where("pay_status", 1)->where("get_status", 1)->where("back_status", 1)->get();
            return $trade;
        }
    }

    public static function getTradeStatus($out_trade_no) {
        $trade = Trade::where("out_trade_no", $out_trade_no)->first();
        if (!$trade)
            return 0;
        if (($trade->pay_status == 1) && ($trade->get_status == 0)){
            return 2;
        }
        else  if (($trade->pay_status == 1) && ($trade->get_status == 1) && ($trade->back_status == 0)){
            return 3;
        }
        else  if (($trade->pay_status == 1) && ($trade->get_status == 1) && ($trade->back_status == 1)){
            return 4;
        }
    }
}