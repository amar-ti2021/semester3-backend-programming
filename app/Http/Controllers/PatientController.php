<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function index()
    {
        // mengambil seluruh data pasien 
        $data = Patient::all();

        // response apabila data tidak kosong
        if ($data->count() > 0) {
            $response = [
                "message" => "Get All Resource",
                "data" => $data
            ];
        }
        // response apabila data kosong
        else {
            $response = [
                "message" => "Data is Empty"
            ];
        }

        // mengembalikan response 
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Membuat validator untuk request yang dikirim 
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'phone' => ['numeric', 'required'],
            'address' => ['required'],
            'status_id' => ['numeric', 'required', Rule::in([1, 2, 3])],
            'in_date_at' => ['date', 'required'],
            'out_date_at' => ['date'],
        ]);

        // Jika request tidak tervalidasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // Jika request sudah tervalidasi  
        try {
            // Memasukkan data ke dalam database 
            $patient = Patient::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'status_id' => $request->status_id,
                'in_date_at' => $request->in_date_at,
                'out_date_at' => $request->out_date_at ?? null,
            ]);

            // membuat response 
            $response = [
                'message' => "Resource is added successfully",
                'data' => $patient
            ];

            // mengembalikan response 
            return response()->json($response, Response::HTTP_CREATED);
        }

        // Jika gagal memasukkan data 
        catch (QueryException $e) {
            return response()->json([
                'message' => $e->errorInfo
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        // Mencari data pasien 
        $patient = Patient::find($id);

        // response apabila tidak ditemukan 
        if (is_null($patient)) {
            $response = [
                "message" => "Resource not found"
            ];
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
        // response apabila pasien ditemukan
        $response = [
            "message" => "Get All Resource",
            "data" => $patient
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function update($id, Request $request)
    {
        // Mencari data pasien 
        $patient = Patient::find($id);

        // response apabila tidak ditemukan 
        if (is_null($patient)) {
            $response = [
                "message" => "Resource not found"
            ];
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        // Membuat validator untuk request yang dikirim 
        $validator = Validator::make($request->all(), [
            'phone' => ['numeric'],
            'status_id' => ['numeric', Rule::in([1, 2, 3])],
            'in_date_at' => ['date'],
            'out_date_at' => ['date'],
        ]);

        // Jika request tidak tervalidasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // Jika request sudah tervalidasi  
        try {
            // Mengupdate data dalam database 
            $patient->update([
                'name' => $request->name ?? $patient->name,
                'phone' => $request->phone ?? $patient->phone,
                'address' => $request->address ?? $patient->address,
                'status_id' => $request->status_id ?? $patient->status_id,
                'in_date_at' => $request->in_date_at ?? $patient->in_date_at,
                'out_date_at' => $request->out_date_at ?? $patient->out_date_at,
            ]);

            // membuat response 
            $response = [
                'message' => "Resource is updated successfully",
                'data' => $patient
            ];

            // mengembalikan response 
            return response()->json($response, Response::HTTP_OK);
        }

        // Jika gagal memasukkan data 
        catch (QueryException $e) {
            return response()->json([
                'message' => $e->errorInfo
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        // Mencari data pasien 
        $patient = Patient::find($id);

        // response apabila tidak ditemukan 
        if (is_null($patient)) {
            $response = [
                "message" => "Resource not found"
            ];
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }

        // Menghapus data apabila data ditemukan 
        $patient->delete();

        // Mengembalikan response 
        return response()->json(["message" => "Resource is Deleted Successfully"], Response::HTTP_OK);
    }

    public function search($name)
    {
        // Mencari data pasien 
        $patient = Patient::where('name', 'like', "%$name%")->get();

        // response apabila tidak ditemukan 
        if ($patient->count() <= 0) {
            $response = [
                "message" => "Resource not found"
            ];
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
        // response apabila pasien ditemukan
        $response = [
            "message" => "Get Searched Resource",
            "data" => $patient
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function positive()
    {
        // mengambil seluruh data pasien positif
        $data = Patient::where('status_id', 1)->get();

        // response apabila data tidak kosong
        if ($data->count() > 0) {
            $response = [
                "message" => "Get Positive Resources",
                'total' => $data->count(),
                "data" => $data
            ];
        }
        // response apabila data kosong
        else {
            $response = [
                "message" => "Data is Empty"
            ];
        }

        // mengembalikan response 
        return response()->json($response, Response::HTTP_OK);
    }

    public function recovered()
    {
        // mengambil seluruh data pasien sembuh
        $data = Patient::where('status_id', 2)->get();

        // response apabila data tidak kosong
        if ($data->count() > 0) {
            $response = [
                "message" => "Get Recovered Resources",
                'total' => $data->count(),
                "data" => $data
            ];
        }
        // response apabila data kosong
        else {
            $response = [
                "message" => "Data is Empty"
            ];
        }

        // mengembalikan response 
        return response()->json($response, Response::HTTP_OK);
    }
    public function dead()
    {
        // mengambil seluruh data pasien meninggal
        $data = Patient::where('status_id', 3)->get();

        // response apabila data tidak kosong
        if ($data->count() > 0) {
            $response = [
                "message" => "Get Dead Resources",
                'total' => $data->count(),
                "data" => $data
            ];
        }
        // response apabila data kosong
        else {
            $response = [
                "message" => "Data is Empty"
            ];
        }

        // mengembalikan response 
        return response()->json($response, Response::HTTP_OK);
    }
}
