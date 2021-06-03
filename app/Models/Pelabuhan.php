<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pelabuhan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function join()
    {
        $data = DB::table('pelabuhans')
        ->join('katalog_pelabuhans','pelabuhans.pelabuhan_id','katalog_pelabuhans.id')
        ->join('katalog_kapals','pelabuhans.kapal_id','katalog_kapals.id')
        ->select('pelabuhans.*','katalog_pelabuhans.nama_pelabuhan','katalog_kapals.nama_kapal');

        return $data;
    }
}
