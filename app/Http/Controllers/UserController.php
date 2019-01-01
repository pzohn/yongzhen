<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Libs\GuzzleHttp;

class UserController extends Controller
{
    public function getUser(Request $req) {
        $id = $req->get('id');
        $user = User::getUser($id);
        return $user;
    }
}