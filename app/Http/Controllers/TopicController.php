<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Reply;


class TopicController extends Controller
{
    public function getTopicsByTab(Request $req) {
        $tab = $req->get('tab');
        $topics = Topic::GetTopicsByTab($tab);
        return [
            "count" => count($topics),
            "topics" => $topics
        ];
    }

    public function getTopicById(Request $req) {
        $id = $req->get('id');
        $topic = Topic::GetTopicById($id);
        $replies = Reply::GetRepliesByTopicId($id);
        return [
            "loginname" => $topic->loginname,
            "avatar_url" => $topic->avatar_url,
            "content" => $topic->content,
            "good" => $topic->good,
            "title" => $topic->title,
            "top" => $topic->top,
            "last_reply_at" => $topic->last_reply_at,
            "replies_count" => count($replies),
            "replies" => $replies
        ];
    }
}
