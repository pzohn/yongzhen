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

    public function login(Request $req) {
        $phone = $req->get('phone');
        $passwd = $req->get('passwd');
        $user = User::UserLogin($phone,$passwd);
        return $user;
    }

    public function registor(Request $req) {
        $user = User::UserInsert($req);
        return $user;
    }
}