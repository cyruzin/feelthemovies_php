<?php

namespace App\Http\Controllers;

use ApiHelper;
use App\Genre;
use App\Keyword;
use App\Recommendation;
use App\Source;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function user(Request $request)
    {
        try {
            if (empty($request->q)) {
                return response()->json(['message' => 'Query field is empty.'], 400);
            }
            return response()->json(
                User::where('name', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('id', '=', $request->q)
                    ->get()
                    ->take(20)
            );
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

    public function recommendation(Request $request)
    {
        $this->validate($request, [
            'q' => 'required'
        ]);

        $search = $request->q;

        try {
            $rec = Recommendation::with(['keywords', 'genres']);

            $rec->where('title', 'LIKE', '%' . $search . '%');

            if ($request->has('type')) {
                $rec->where('type', intval($request->type));
            }

            if (!$request->has('nofilter')) {
                $rec->where('status', 1);
            }

            $rec->orWhereHas('keywords', function ($query) use ($search, $request) {
                if ($request->has('type')) {
                    $query->where('type', intval($request->type));
                }

                if (!$request->has('nofilter')) {
                    $query->where('status', 1);
                }
                $query->where('name', 'LIKE', '%' . $search . '%');
            });

            $rec->orWhereHas('genres', function ($query) use ($search, $request) {
                if ($request->has('type')) {
                    $query->where('type', intval($request->type));
                }

                if (!$request->has('nofilter')) {
                    $query->where('status', 1);
                }
                $query->where('name', 'LIKE', '%' . $search . '%');
            });

            $rec = $rec->orderByDesc('id')->paginate(10);


            return response()->json($rec, 200);
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

    public function genre(Request $request)
    {
        try {
            if (empty($request->q)) {
                return response()->json(['message' => 'Query field is empty.'], 400);
            }
            return response()->json(
                Genre::where('name', 'LIKE', '%' . $request->q . '%')->get()->take(20)
            );
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

    public function keyword(Request $request)
    {
        try {
            if (empty($request->q)) {
                return response()->json(['message' => 'Query field is empty.'], 400);
            }
            return response()->json(
                Keyword::where('name', 'LIKE', '%' . $request->q . '%')->get()->take(20)
            );
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

    public function source(Request $request)
    {
        try {
            if (empty($request->q)) {
                return response()->json(['message' => 'Query field is empty.'], 400);
            }
            return response()->json(
                Source::where('name', 'LIKE', '%' . $request->q . '%')->get()->take(20)
            );
        } catch (\Exception $e) {
            return ApiHelper::errorHandler($e);
        }
    }

}
