<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakulikuler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EkstrakulikulerController extends Controller
{
    public function index()
{
    $ekstrakulikulers = Ekstrakulikuler::all();

    return response()->json([
        'status' => 'success',
        'data' => $ekstrakulikulers,
        'message' => 'ekstrakulikuler retrieved successfully!',
    ], 200);
}

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255'
    ]);

    $post = null;

    DB::transaction(function () use ($request, &$post) {

        $post = Ekstrakulikuler::create([
            'nama' => $request->nama,
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
            'nama' => 'required|string|max:255',
        ]);

        $ekskul = Ekstrakulikuler::findOrFail($id);

        $ekskul->nama = $request->input('nama');

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
    $ekskul = Ekstrakulikuler::findOrFail($id);

    DB::transaction(function () use ($ekskul) {
        $ekskul->delete();
    });

    return response()->json([
        'status' => 'success',
        'message' => 'Ekstrakulikuler deleted successfully!',
    ], 200);
}

}
