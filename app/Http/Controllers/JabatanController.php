<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

//model
use App\Models\JabatanModel;

class JabatanController
{
    private $modelName = 'Data Jabatan';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = JabatanModel::all();

        return view('master_data.jabatan.index', [
            "jabatan" => $jabatan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master_data.jabatan.create');
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
            // Ambil semua data request
            $data = $request->all();
            $data['status']     = 1;
            $data['created_by'] = Auth::user()->id;
            $simpan = JabatanModel::create($data);
            
            if ($simpan) {
                DB::commit();
                return response()->json(['status' => true, 'message' => "Data berhasil ditambahkan!", 'url' => '/jabatan'], 200);
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
        $id_jabatan = Crypt::decrypt($id);
        $data['jabatan'] = JabatanModel::findOrFail($id_jabatan);
        return view('master_data.jabatan.edit', $data);
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
            $data_jabatan = JabatanModel::findOrFail($id);
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $simpan = $data_jabatan->update($data);

            if ($simpan) {
                DB::commit();
                return response()->json(['status' => true, 'message' => "Data berhasil diedit!", 'url' => '/jabatan'], 200);
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
