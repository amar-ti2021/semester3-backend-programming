<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        return response()->json([
            "message" => "Menampilkan Data Animals"
        ]);
    }
    public function store(Request $request)
    {
        return response()->json([
            "nama" => $request->nama,
            "message" => "Menambahkan Data Animals"
        ]);
    }
    public function update($id, Request $request)
    {
        return response()->json([
            "nama" => $request->nama,
            "message" => "Mengubah Data Animals dengan id $id"
        ]);
    }
    public function destroy($id, Request $request)
    {
        return response()->json([
            "message" => "Menghapus Data Animals dengan id $id"
        ]);
    }
}
