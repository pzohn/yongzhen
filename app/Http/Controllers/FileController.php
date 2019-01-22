<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class FileController extends Controller
{
    public function uploadimg(Request $req)
    {
         $file = $req->file('file');
         if($file) {
            $info = $file->move('public/upload/weixin/');
            if ($info) {
                $file = $info->getSaveName();
                $res = ['errCode'=>0,'errMsg'=>'图片上传成功','file'=>$file];
                return json($res);
            }
        }
       
    }
}
