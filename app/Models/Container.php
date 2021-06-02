<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Container extends Model
{
    use HasFactory;

    protected $guarded =  [];

    public static function join()
    {
        $data = DB::table('containers')
        ->join('katalog_containers','containers.container_id','katalog_containers.id')
        ->select('containers.*','katalog_containers.nama_container as nama_container');

        return $data;
    }
}
