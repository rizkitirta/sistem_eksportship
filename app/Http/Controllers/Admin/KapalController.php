<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kapal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class KapalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Kapal::all();
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

        return view('admin.kapal.index', compact('data'));
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
            'nama_kapal' => 'required|string',
            'jenis_kapal' => 'required|string',
            'kecepatan' => 'required|string',
            'berat_muatan' => 'required|string',
            'daya_mesin' => 'required|string',
            'letak_mesin' => 'required|string',
        ];

        $message = [
            'nama_kapal.required' => 'Kolom nama tidak boleh kosong!',
            'jenis_kapal.required' => 'Kolom jenis tidak boleh kosong!',
            'kecepatan.required' => 'Kolom kecepatan tidak boleh kosong!',
            'berat_muatan.required' => 'Kolom berat pelabuhan tidak boleh kosong!',
            'daya_mesin.required' => 'Kolom daya pelabuhan tidak boleh kosong!',
            'letak_mesin.required' => 'Kolom letak pelabuhan tidak boleh kosong!',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);
        if ($validasi->fails()) {
            return response()->json(['message' => $validasi->errors()->first()], 422);
        }

        $data = Kapal::create($request->all());
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
        $data = Kapal::find($request->id);
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
            'nama_kapal' => 'required|string',
            'jenis_kapal' => 'required|string',
            'kecepatan' => 'required|string',
            'berat_muatan' => 'required|string',
            'daya_mesin' => 'required|string',
            'letak_mesin' => 'required|string',
        ];

        $message = [
            'nama_kapal.required' => 'Kolom nama tidak boleh kosong!',
            'jenis_kapal.required' => 'Kolom jenis tidak boleh kosong!',
            'kecepatan.required' => 'Kolom kecepatan tidak boleh kosong!',
            'berat_muatan.required' => 'Kolom berat pelabuhan tidak boleh kosong!',
            'daya_mesin.required' => 'Kolom daya pelabuhan tidak boleh kosong!',
            'letak_mesin.required' => 'Kolom letak pelabuhan tidak boleh kosong!',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);
        if ($validasi->fails()) {
            return response()->json(['message' => $validasi->errors()->first()], 422);
        }

        $data = Kapal::find($request->id);
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
        $data = Kapal::find($request->id);
        $data->delete($data);
        if ($data) {
            return response()->json(['message' => 'Data Berhasil Dihapus']);
        } else {
            return response()->json(['message' => 'Data Gagal Dihapus']);
        }
    }
}
