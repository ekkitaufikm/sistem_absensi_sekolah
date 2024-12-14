<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

//model
use App\Models\User;

class UserController
{
    private $modelName = 'Data Karyawan';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('master_data.karyawan.index', [
            "users" => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master_data.karyawan.create');
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
            $data['password']   = Hash::make($request->password);
            $data['sandi']      = $request->password;
            $data['status']     = 1;
            $data['created_by'] = Auth::user()->id;
            $simpan = User::create($data);
            
            if ($simpan) {
                DB::commit();
                return response()->json(['status' => true, 'message' => "Data berhasil ditambahkan!", 'url' => '/karyawan'], 200);
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
        $id_karyawan = Crypt::decrypt($id);
        $data['users'] = User::findOrFail($id_karyawan);
        return view('master_data.karyawan.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id_karyawan = Crypt::decrypt($id);
        $data['users'] = User::findOrFail($id_karyawan);
        return view('master_data.karyawan.edit', $data);
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
            if($request->password != null){
                if ($request->password != $request->verifikasi) {
                    return response()->json(['status' => false, 'message' => 'Verifikasi password harus sama dengan password'], 200);
                } else {
                    if ($request->m_role_id == 0){
                        return response()->json(['status' => false, 'message' => 'Harap Pilih Hak Akses!'], 200);
                    } else {
                        if($request->status == 0){
                            return response()->json(['status' => false, 'message' => 'Harap Input Status!'], 200);
                        } else {
                            $data_karyawan = User::findOrFail($id);
                            $data = $request->all();
                            $data['password']   = Hash::make($request->password);
                            $data['sandi']      = $request->password;
                            $data['updated_by'] = Auth::user()->id;
                            $simpan = $data_karyawan->update($data);
                        }
                    }
                }
            } else {
                if ($request->m_role_id == 0){
                    return response()->json(['status' => false, 'message' => 'Harap Pilih Hak Akses!'], 200);
                } else {
                    if($request->status == 0){
                        return response()->json(['status' => false, 'message' => 'Harap Input Status!'], 200);
                    } else {
                        $data_karyawan = User::findOrFail($id);
                        $data = $request->all();
                        $data['updated_by'] = Auth::user()->id;
                        $simpan = $data_karyawan->update($data);
                    }
                }
            }

            if ($simpan) {
                DB::commit();
                return response()->json(['status' => true, 'message' => "Data berhasil diedit!", 'url' => '/karyawan'], 200);
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
