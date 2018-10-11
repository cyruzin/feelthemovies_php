<?php

namespace App\Http\Controllers;

use App\Recommendation;
use ApiHelper;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index()
    {
        try {
            return response()->json(Recommendation::with(['genres', 'keywords'])
                ->orderByDesc('id')
                ->paginate(20));
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
            return response()->json(Recommendation::with(['genres', 'keywords'])->findOrFail($id), 200);
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
            'user_id' => 'required',
            'title' => 'required',
            'body' => 'required',
            'poster' => 'required',
            'backdrop' => 'required'
        ]);

        try {
            $recommendation = Recommendation::create($request->all());

            $genres = array_filter($request->genres);
            $keywords = array_filter($request->keywords);

            if (!empty($genres)) {
                $recommendation->genres()->attach($request->genres);
            }

            if (!empty($keywords)) {
                $recommendation->keywords()->attach($request->keywords);
            }

            $recommendation = Recommendation::with(['keywords', 'genres'])->findOrFail($recommendation->id);

            return response()->json($recommendation, 201);
        } catch (\Exception  $e) {
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
            'title' => 'required',
            'body' => 'required',
            'status' => 'required',
            'poster' => 'required',
            'backdrop' => 'required'
        ]);

        try {
            $recommendation = Recommendation::findOrFail($id);

            $recommendation->update($request->all());

            $genres = array_filter($request->genres);
            $keywords = array_filter($request->keywords);

            if (!empty($genres)) {
                $recommendation->genres()->sync($request->genres);
            }

            if (!empty($keywords)) {
                $recommendation->keywords()->sync($request->keywords);
            }

            $recommendation = Recommendation::with(['keywords', 'genres'])->findOrFail($id);


            return response()->json($recommendation, 200);
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

            Recommendation::findOrFail($id)->delete();
            return response()->json(['message' => 'Deleted successfully'], 200);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

}
