<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Reply extends Model {
        
    public static function GetRepliesByTopicId($id) {
        $replies = Reply::where("topic_id", $id)->get();
        if ($replies) {
            return $replies;
        }
    }
}