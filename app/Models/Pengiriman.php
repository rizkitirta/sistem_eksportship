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
            ->join('katalog_kapals', 'data_pengiriman.kapal_id', 'katalog_kapals.id')
            ->join('katalog_pelabuhans', 'data_pengiriman.pelabuhan_id', 'katalog_pelabuhans.id')
            ->join('statuses', 'data_pengiriman.status', 'statuses.status_code')
            ->select(
                'data_pengiriman.*',
                'katalog_kapals.nama_kapal',
                'katalog_pelabuhans.nama_pelabuhan',
                'statuses.status_name'
            )->get();

        return $data;
    }


}
