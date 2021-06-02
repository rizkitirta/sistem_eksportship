<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Container::all();
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

        return view('admin.kontainer.index', compact('data'));
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
            'nama_container' => 'required|string',
            'ukuran_container' => 'required|string',
            'jenis_muatan' => 'required|string',
            'isi_muatan' => 'required|string',
        ];

        $message = [
            'nama_container.required' => 'Kolom negara tidak boleh kosong!',
            'ukuran_container.required' => 'Kolom lokasi tidak boleh kosong!',
            'jenis_muatan.required' => 'Kolom operator tidak boleh kosong!',
            'isi_muatan.required' => 'Kolom otoritas pelabuhan ridak boleh kosong!',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);
        if ($validasi->fails()) {
            return response()->json(['message' => $validasi->errors()->first()], 422);
        }

        $data = Container::create($request->all());
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
        $data = Container::find($request->id);
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
            'negara' => 'required|string',
            'lokasi' => 'required|string',
            'operator' => 'required|string',
            'otoritas_pelabuhan' => 'required|string',
            'jenis_pelabuhan' => 'required',
            'menghubungkan_ke' => 'required',
            'jenis_dermaga' => 'required',
            'kedatangan' => 'required',
        ];

        $message = [
            'negara.required' => 'Kolom negara tidak boleh kosong!',
            'lokasi.required' => 'Kolom lokasi tidak boleh kosong!',
            'operator.required' => 'Kolom operator tidak boleh kosong!',
            'otoritas_pelabuhan.required' => 'Kolom otoritas pelabuhan ridak boleh kosong!',
            'jenis_pelabuhan.required' => 'Kolom Jenis Pelabuhan tidak boleh kosong!',
            'menghubungkan_ke.required' => 'Kolom Menghubungkan tidak boleh kosong!',
            'jenis_dermaga.required' => 'Kolom Jenis Dermaga tidak boleh kosong!',
            'kedatangan.required' => 'Kolom kedatangan tidak boleh kosong!',
        ];

        $validasi = Validator::make($request->all(), $rules, $message);
        if ($validasi->fails()) {
            return response()->json(['message' => $validasi->errors()->first()], 422);
        }

        $data = Pelabuhan::find($request->id);
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
        $data = Pelabuhan::find($request->id);
        $data->delete($data);
        if ($data) {
            return response()->json(['message' => 'Data Berhasil Dihapus']);
        } else {
            return response()->json(['message' => 'Data Gagal Dihapus']);
        }
    }
}
