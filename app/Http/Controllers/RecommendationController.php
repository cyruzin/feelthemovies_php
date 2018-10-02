<?php

namespace App\Http\Controllers;

use App\Recommendation;
use ApiHelper;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index()
    {
        try {
            return response()->json(Recommendation::all()->sortByDesc('id')->take(30));
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

    public function show($id)
    {
        try {
            return response()->json(Recommendation::find($id), 200);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
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
            $rec = Recommendation::create($request->all());

            $genres = array_filter($request->genres);
            $keywords = array_filter($request->keywords);

            if (!empty($genres)) {
                $rec->genres()->attach($request->genres);
            }

            if (!empty($keywords)) {
                $rec->keywords()->attach($request->keywords);
            }

            return response()->json($rec, 201);
        } catch (\Exception  $e) {
            return ApiHelper::errorHandler($e);
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
            return ApiHelper::errorHandler($e);
        }
    }

    public function delete($id)
    {
        try {
            Recommendation::findOrFail($id)->delete();
            return response()->json(['message' => 'Deleted successfully'], 200);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

}
