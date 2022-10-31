<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        $data = [
            'message' => 'Get All Student',
            'data' => $students
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ];

        $student = Student::create($input);

        $data = [
            'message' => 'Data Created Successfully',
            'data' => $student
        ];

        return response()->json($data, 201);
    }
    public function update(Request $request)
    {
        $student = Student::findOrFail($request->id);

        $student->update($request->all());

        $data = [
            'message' => 'Data Updated Successfully',
            'data' => $student
        ];

        return response()->json($data, 200);
    }
    public function destroy(Request $request)
    {
        $student = Student::findOrFail($request->id);

        $student->delete();

        $data = [
            'message' => 'Data Deleted Successfully',
        ];

        return response()->json($data, 200);
    }
}
