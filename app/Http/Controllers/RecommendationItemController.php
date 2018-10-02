<?php

namespace App\Http\Controllers;

use App\RecommendationItem;
use ApiHelper;
use Illuminate\Http\Request;

class RecommendationItemController extends Controller
{

    public function show($id)
    {
        try {
            return response()->json(RecommendationItem::all()->where('recommendation_id', $id), 200);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'recommendation_id' => 'required',
            'name' => 'required',
            'year' => 'required',
            'overview' => 'required',
            'poster' => 'required',
            'backdrop' => 'required',
        ]);

        try {
            $recItem = RecommendationItem::create($request->all());

            $sources = array_filter($request->sources);

            if (!empty($sources)) {
                $recItem->sources()->attach($request->sources);
            }

            return response()->json($recItem, 201);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'year' => 'required',
            'overview' => 'required',
            'poster' => 'required',
            'backdrop' => 'required',
        ]);

        try {
            $rec = RecommendationItem::findOrFail($id);
            $rec->update($request->all());

            return response()->json($rec, 200);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

    public function delete($id)
    {
        try {
            RecommendationItem::findOrFail($id)->delete();
            return response()->json(['message' => 'Deleted successfully'], 200);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

}