<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Good;
use App\Libs\GuzzleHttp;

class UserController extends Controller
{
    public function getGood() {
        $good = Good::GetGood();
        return $good;
    }
}