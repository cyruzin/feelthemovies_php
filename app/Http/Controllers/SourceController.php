<?php

namespace App\Http\Controllers;

use App\Source;
use ApiHelper;
use Illuminate\Http\Request;

class SourceController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index()
    {
        try {
            return response()->json(Source::paginate(30));
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
            return response()->json(Source::find($id), 200);
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
        $this->validate($request, ['name' => 'required']);
        try {
            return response()->json(Source::create($request->all(), 201));
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
        $this->validate($request, ['name' => 'required']);

        try {
            $rec = Source::findOrFail($id);
            $rec->update($request->all());

            return response()->json($rec, 200);
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
            Source::findOrFail($id)->delete();
            return response()->json(['message' => 'Deleted successfully'], 200);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

}
