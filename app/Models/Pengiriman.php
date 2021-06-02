<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'data_pengiriman';

    protected $guarded = [];

    public static function join()
    {
       $data = DB::table('data_pengiriman')
            ->join('kapals', 'data_pengiriman.kapal_id', 'kapals.id')
            ->join('pelabuhans', 'data_pengiriman.asal', 'pelabuhans.id')
            ->select(
                'data_pengiriman.*',
                'kapals.nama_kapal',
                'pelabuhans.nama_pelabuhan',
            )->get();

        return $data;
    }


}
