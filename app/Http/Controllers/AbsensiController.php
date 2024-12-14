<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

//model
use App\Models\AbsensiModel;

class AbsensiController
{
    private $modelName = 'Data Absensi';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensi = AbsensiModel::all();

        return view('absensi.index', [
            "absensi" => $absensi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('absensi.create');
    }

    public function rules($request)
    {
        $rule = [];
        $message = [];

        return Validator::make($request, $rule, $message);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = $this->rules($request->all());

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()], 200);
        }

        DB::beginTransaction();
        try {
            // Deklarasi awal untuk variabel $simpan
            $simpan = false;

            if ($request->clock_type == 'Clock In') {
                // Ambil semua data request
                $data = $request->all();
                $data['user_id'] = Auth::user()->id;
                $data['created_by'] = Auth::user()->id;
                $simpan = AbsensiModel::create($data);

            } elseif ($request->clock_type == 'Clock Out') {
                $data_absensi = AbsensiModel::where('user_id', Auth::user()->id)->first();
                // Ambil semua data request
                $data = [
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'waktu_pulang' => $request->waktu,
                    'today_date' => $request->today_date,
                    'clock_type_pulang' => $request->clock_type,
                ];
                $simpan = $data_absensi ? $data_absensi->update($data) : false;
            }

            if ($simpan) {
                DB::commit();
                return response()->json(['status' => true, 'message' => "Data berhasil ditambahkan!", 'url' => '/absensi'], 200);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'message' => "Gagal menambahkan data"], 200);
            }

        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollback();
            return response()->json(['status' => false, 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id_absensi = Crypt::decrypt($id);
        $data['absensi'] = AbsensiModel::findOrFail($id_absensi);
        return view('absensi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $this->rules($request->all());

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()], 200);
        }

        DB::beginTransaction();
        try {
            $data_absensi = AbsensiModel::findOrFail($id);
            $data = $request->all();
            $data['updated_by'] = Auth::user()->id;
            $simpan = $data_absensi->update($data);

            if ($simpan) {
                DB::commit();
                return response()->json(['status' => true, 'message' => "Data berhasil diedit!", 'url' => '/absensi'], 200);
            } else {
                DB::rollback();
                return response()->json(['status' => false, 'message' => "Gagal menambahkan data"], 200);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => $e->getMessage()], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       //
    }

}
