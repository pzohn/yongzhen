<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

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
}
