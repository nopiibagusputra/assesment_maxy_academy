<?php

namespace App\Http\Controllers\API\V1;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Http\Resources\SiswaResources;
use App\Http\Requests\AddSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;

class SiswaController extends Controller
{
    /**
     * Display siswa.
     */
    public function index()
    {
        $siswa = Siswa::all();
        return SiswaResources::collection($siswa);
    }

    /**
     * Store siswa resource in storage.
     */
    public function store(AddSiswaRequest $request)
    {
        Siswa::create([
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'alamat'        => $request->alamat,
            'telp'          => $request->telp,
            'kelas'         => $request->kelas,
            'jk'            => $request->jk,
            'status'        => $request->status
        ]);

        return response()->json([
         'message' => 'Siswa berhasil ditambahkan'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            return new SiswaResources($siswa);
        } catch (Exception $e) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, string $id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->update($request->all());

            return new SiswaResources($siswa);
        } catch (Exception $e) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();

            return response()->json([
               'message' => 'Siswa berhasil dihapus'
            ], 204);
        } catch (Exception $e) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }
    }
}
