<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Topic extends Model {
        
    public static function GetTopicById($id) {
        $topics= Topic::where("id", $id)->first();
        if ($topic) {
            return $topic;
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

    public static function InsertTopic($params) {
        $topic = new self;
        $topic->loginname = array_get($params,"loginname");
        $topic->avatar_url = array_get($params,"avatar_url");
        $topic->content = array_get($params,"content");
        $topic->title = array_get($params,"title");
        $topic->login_id = array_get($params,"login_id");
        $topic->last_reply_at = array_get($params,"last_reply_at");
        $topic->tab = array_get($params,"tab");
        $topic->save();
        return $topic;
    }
}