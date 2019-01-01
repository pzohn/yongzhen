<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Good;
use App\Libs\GuzzleHttp;

class GoodController extends Controller
{
    public function getGood() {
        $good = Good::GetGood();
        $count = Good::GetGoodCount();
        return [
            $count,
            $good
        ];
    }

    public function getGoodByType(Request $req) {
        $type_id = $req->get('type_id');
        $good = Good::GetGoodByType($type_id);
        $count = Good::GetGoodCountByType();
        return [
            $count,
            $good
        ];
    }
}