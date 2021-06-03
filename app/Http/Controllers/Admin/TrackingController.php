<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{

    public function index()
    {
        $data = DB::table('data_pengiriman')
        ->join('katalog_pelabuhans','data_pengiriman.pelabuhan_id','katalog_pelabuhans.id')
        ->join('katalog_kapals','data_pengiriman.kapal_id','katalog_kapals.id')
        ->get();
        return view('admin.tracking.index',compact('data'));
    }

    public function dikemas()
    {
        $data = DB::table('data_pengiriman')
        ->join('katalog_pelabuhans','data_pengiriman.pelabuhan_id','katalog_pelabuhans.id')
        ->join('katalog_kapals','data_pengiriman.kapal_id','katalog_kapals.id')
        ->where('status',0)->get();
        return view('admin.tracking.index',compact('data'));
    }

    public function dikirim()
    {
        $data = DB::table('data_pengiriman')
        ->join('katalog_pelabuhans','data_pengiriman.pelabuhan_id','katalog_pelabuhans.id')
        ->join('katalog_kapals','data_pengiriman.kapal_id','katalog_kapals.id')
        ->where('status',1)->get();
        return view('admin.tracking.index',compact('data'));
    }

    public function sampai()
    {
        $data = DB::table('data_pengiriman')
        ->join('katalog_pelabuhans','data_pengiriman.pelabuhan_id','katalog_pelabuhans.id')
        ->join('katalog_kapals','data_pengiriman.kapal_id','katalog_kapals.id')
        ->where('status',2)->get();
        return view('admin.tracking.index',compact('data'));
    }

    public function diterima()
    {
        $data = DB::table('data_pengiriman')
        ->join('katalog_pelabuhans','data_pengiriman.pelabuhan_id','katalog_pelabuhans.id')
        ->join('katalog_kapals','data_pengiriman.kapal_id','katalog_kapals.id')
        ->where('status','>',3)->get();
        return view('admin.tracking.index',compact('data'));
    }


}
