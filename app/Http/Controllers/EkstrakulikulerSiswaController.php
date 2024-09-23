<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EkstrakulikulerSiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EkstrakulikulerSiswaController extends Controller
{
    public function index()
{
    $ekstrakulikulers = EkstrakulikulerSiswa::all();

    return response()->json([
        'status' => 'success',
        'data' => $ekstrakulikulers,
        'message' => 'ekstrakulikuler retrieved successfully!',
    ], 200);
}

    public function store(Request $request)
{
    $request->validate([
        'ekskul_id' => 'required|string|max:255',
        'siswa_id' => 'required|string|max:255',
        'year' => 'required|string|max:255'
    ]);

    $post = null;

    DB::transaction(function () use ($request, &$post) {

        $post = EkstrakulikulerSiswa::create([
            'ekstrakulikuler_id' => $request->ekskul_id,
            'student_id' => $request->siswa_id,
            'year' => $request->year
        ]);
    });

return response()->json([
        'status' => 'success',
        'data' => $post,
        'message' => 'Ekstrakulikuler created successfully!',
    ], 201);
}

public function update(Request $request, $id)
{
    try {
        $request->validate([
            'ekskul_id' => 'required|string|max:255',
            'siswa_id' => 'required|string|max:255',
            'year' => 'required|string|max:255'
        ]);

        $ekskul = EkstrakulikulerSiswa::findOrFail($id);

        $ekskul->ekstrakulikuler_id = $request->input('ekskul_id');
        $ekskul->student_id = $request->input('siswa_id');
        $ekskul->year = $request->input('year');

        $ekskul->save();

        return response()->json([
            'message' => 'Ekstrakulikuler updated successfully',
            'data' => $ekskul
        ], 200);

    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'message' => 'Ekstrakulikuler not found'
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred while updating the Ekstrakulikuler',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function destroy($id)
{
    $ekskul = EkstrakulikulerSiswa::findOrFail($id);

    DB::transaction(function () use ($ekskul) {
        $ekskul->delete();
    });

    return response()->json([
        'status' => 'success',
        'message' => 'Ekstrakulikuler deleted successfully!',
    ], 200);
}

}
