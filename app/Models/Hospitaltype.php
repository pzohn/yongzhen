<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Hospitaltype extends Model {
        
    public $timestamps = false;

    public static function GetTypes() {
        $hospitaltypes = Hospitaltype::get();
        if ($hospitaltypes) {
            return $hospitaltypes;
        }
    }
}