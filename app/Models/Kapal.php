<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kapal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function join()
    {
        $data = DB::table('kapals')
        ->join('katalog_kapals','kapals.kapal_id','katalog_kapals.id')
        ->join('katalog_containers','kapals.container_id','katalog_containers.id')
        ->select('kapals.*','katalog_kapals.nama_kapal','katalog_containers.nama_container');

        return $data;
    }
}
