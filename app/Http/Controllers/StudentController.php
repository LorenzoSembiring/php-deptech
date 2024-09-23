<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
{
    $students = Student::all();

    return response()->json([
        'status' => 'success',
        'data' => $students,
        'message' => 'Students retrieved successfully!',
    ], 200);
}

    public function store(Request $request)
{
    $request->validate([
        'nama_depan' => 'required|string|max:255',
        'nama_belakang' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'nomor_induk' => 'required|string|max:20',
        'alamat' => 'required|string|max:500',
        'jenis_kelamin' => 'required',
        'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    $post = null;

    DB::transaction(function () use ($request, &$post) {
        $photoPath = null;
        if ($request->hasFile('foto')) {
            $photoPath = $request->file('foto')->store('photos', 'public');
        }

        $post = Student::create([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'nomor_hp' => $request->phone,
            'NISN' => $request->nomor_induk,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $photoPath,
        ]);
    });

return response()->json([
        'status' => 'success',
        'data' => $post,
        'message' => 'Student created successfully!',
    ], 201);
}

public function update(Request $request, $id)
{
    try {
        $request->validate([
            'nama_depan' => 'sometimes|required|string|max:255',
            'nama_belakang' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:15',
            'nomor_induk' => 'sometimes|required|string|max:20',
            'alamat' => 'sometimes|required|string|max:500',
            'jenis_kelamin' => 'sometimes|required|string|in:male,female,other',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $student = Student::findOrFail($id);

        $student->fill($request->only([
            'nama_depan',
            'nama_belakang',
            'alamat',
            'jenis_kelamin'
        ]));

        $student->nomor_hp = $request->input('phone', $student->nomor_hp);
        $student->NISN = $request->input('nomor_induk', $student->NISN);

        if ($request->hasFile('foto')) {
            if ($student->foto) {
                Storage::disk('public')->delete($student->foto);
            }
            $student->foto = $request->file('foto')->store('photos', 'public');
        }

        $student->save();

        return response()->json([
            'message' => 'Student updated successfully',
            'data' => $student
        ], 200);

    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'message' => 'Student not found'
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred while updating the student',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function destroy($id)
{
    $student = Student::findOrFail($id);

    DB::transaction(function () use ($student) {
        if ($student->foto) {
            Storage::disk('public')->delete($student->foto);
        }

        $student->delete();
    });

    return response()->json([
        'status' => 'success',
        'message' => 'Student deleted successfully!',
    ], 200);
}

}
