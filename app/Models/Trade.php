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

}