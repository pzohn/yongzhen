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
}