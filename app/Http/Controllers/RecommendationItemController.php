<?php

namespace App\Http\Controllers;

use App\RecommendationItem;
use ApiHelper;
use Illuminate\Http\Request;

class RecommendationItemController extends Controller
{

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index($id)
    {
        try {
            return response()->json(['data' => RecommendationItem::with('sources')
                ->where('recommendation_id', $id)
                ->get()], 200);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function show($id)
    {
        try {
            return response()->json(RecommendationItem::with('sources')->findOrFail($id), 200);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'recommendation_id' => 'required',
            'name' => 'required',
            'year' => 'required',
            'overview' => 'required',
            'poster' => 'required',
            'backdrop' => 'required',
            'sources' => 'array'
        ]);

        try {
            $recommendationItem = RecommendationItem::create($request->all());

            $sources = array_filter($request->sources);

            if (!empty($sources)) {
                $recommendationItem->sources()->attach($request->sources);
            }

            $recommendationItem = RecommendationItem::with('sources')->findOrFail($recommendationItem->id);

            return response()->json($recommendationItem, 201);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'year' => 'required',
            'overview' => 'required',
            'poster' => 'required',
            'backdrop' => 'required',
            'sources' => 'array'
        ]);

        try {
            $recommendationItem = RecommendationItem::findOrFail($id);
            $recommendationItem->update($request->all());

            $sources = array_filter($request->sources);

            if (!empty($sources)) {
                $recommendationItem->sources()->sync($request->sources);
            }

            $recommendationItem = RecommendationItem::with('sources')->findOrFail($id);

            return response()->json($recommendationItem, 200);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
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