<?php

namespace App\Http\Controllers;

use App\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index()
    {
        try {
            return response()->json(Recommendation::all()->sortByDesc('id')->take(10));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            return response()->json(Recommendation::find($id), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'title' => 'required',
            'body' => 'required',
            'backdrop' => 'required'
        ]);
        try {
            return response()->json(Recommendation::create($request->all(), 201));
        } catch (\Exception  $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'status' => 'required',
            'backdrop' => 'required'
        ]);

        try {
            $rec = Recommendation::findOrFail($id);
            $rec->update($request->all());

            return response()->json($rec, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function delete($id)
    {
        try {
            Recommendation::findOrFail($id)->delete();
            return response()->json(['message' => 'Deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

}
