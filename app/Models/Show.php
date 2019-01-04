<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Show extends Model {
        
    public $timestamps = false;

    public static function GetShows($type) {
        $shows = Show::where("type", $type)->get();
        return $shows;
    }

    public static function GetShowsCount($type) {
        $count = Show::where("type", $type)->get()->count();
        return $count;
    }
}