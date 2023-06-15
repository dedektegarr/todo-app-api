<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = Todo::limit(10)->get();

            if ($response) {
                return response()->json([
                    'code' => 200,
                    'success' => true,
                    'items' => $response,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => 500, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required'
            ]);

            $request['is_completed'] = 0;
            $data = Todo::create($request->all());

            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['code' => 500, 'error' => $e->getMessage()]);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'is_completed' => 'required|numeric'
            ]);

            $data = Todo::findOrFail($id);
            $data->update($request->all());

            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['code' => 500, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $data = Todo::findOrFail($id);
            $data->delete();

            return response()->json([
                'code' => 200,
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json(['code' => 500, 'error' => $e->getMessage()]);
        }
    }
}