<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Topic extends Model {
        
    public static function GetGoodById($id) {
        $topics = Topic::where("id", $id)->first();
        if ($topics) {
            return $topics;
        }
    }

    public static function GetTopicsByTab($tab) {
        if ($tab == 0){
            $topics = Topic::get();
            if ($topics) {
                return $topics;
            }
        }else{
            $topics = Topic::where("tab", $tab)->get();
            if ($topics) {
                return $topics;
            }
        }
    }
}