<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kapal;
use App\Models\Pelabuhan;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kapal = Kapal::all();
        $pelabuhan = Pelabuhan::all();
        $data = Pengiriman::join();
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<button class="edit btn btn-primary btn-sm mr-1" id="' . $data->id . '" name="edit" ><i class="fas fa-edit"></i></button>';
                    $button .= '<button class="hapus btn btn-danger btn-sm " id="' . $data->id . '" name="hapus"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('admin.pengiriman.index', compact('data','kapal','pelabuhan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'kapal_id' => 'required|string',
            'asal' => 'required|string',
            'tujuan' => 'required|string',
            'jumlah_container' => 'required|integer',
            'deskripsi' => 'required|string',
        ];

        $message = [
            'kapal_id.required' => 'Kolom kapal tidak boleh kosong!',
            'asal.required' => 'Kolom asal tidak boleh kosong!',
            'tujuan.required' => 'Kolom tujuan tidak boleh kosong!',
            'jumlah_container.required' => 'Kolom jumlah pelabuhan tidak boleh kosong!',
            'jumlah_container.integer' => 'Kolom jumlah berupa angka!',
            'deskripsi.required' => 'Kolom deskripsi pelabuhan tidak boleh kosong!',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);
        if ($validasi->fails()) {
            return response()->json(['message' => $validasi->errors()->first()], 422);
        }

        $data = Pengiriman::create($request->all());
        if ($data) {
            return response()->json(['message' => 'Data Berhasil Disimpan'], 200);
        } else {
            return response()->json(['message' => 'Data Gagal Disimpan'], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = Pengiriman::find($request->id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'kapal_id' => 'required|string',
            'asal' => 'required|string',
            'tujuan' => 'required|string',
            'jumlah_container' => 'required|string',
            'deskripsi' => 'required|string',
        ];

        $message = [
            'kapal_id.required' => 'Kolom kapal tidak boleh kosong!',
            'asal.required' => 'Kolom asal tidak boleh kosong!',
            'tujuan.required' => 'Kolom tujuan tidak boleh kosong!',
            'jumlah_container.required' => 'Kolom jumlah pelabuhan tidak boleh kosong!',
            'deskripsi.required' => 'Kolom deskripsi pelabuhan tidak boleh kosong!',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);
        if ($validasi->fails()) {
            return response()->json(['message' => $validasi->errors()->first()], 422);
        }

        $data = Pengiriman::find($request->id);
        $data->update($request->all());
        if ($data) {
            return response()->json(['message' => 'Data Berhasil Disimpan'], 200);
        } else {
            return response()->json(['message' => 'Data Gagal Disimpan'], 422);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Pengiriman::find($request->id);
        $data->delete($data);
        if ($data) {
            return response()->json(['message' => 'Data Berhasil Dihapus']);
        } else {
            return response()->json(['message' => 'Data Gagal Dihapus']);
        }
    }
}