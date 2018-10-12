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
        $search = $request->q;
        $keywords = (!empty($request->keywords)) ? array_filter($request->keywords) : '';
        $genres = (!empty($request->genres)) ? array_filter($request->genres) : '';

        if (empty($search) && empty($keywords) && empty($genres)) {
            return response()->json(['message' => 'All fields are empty.'], 400);
        }

        try {
            $rec = Recommendation::with(['keywords', 'genres']);

            if (!empty($search)) {
                $rec->where('title', 'LIKE', '%' . $search . '%');
            }

            if (!empty($keywords)) {
                $rec->whereHas('keywords', function ($query) use ($keywords) {
                    $query->whereIn('keyword_id', $keywords);
                });
            }

            if (!empty($genres)) {
                $rec->whereHas('genres', function ($query) use ($genres) {
                    $query->whereIn('genre_id', $genres);
                });
            }

            $rec = $rec->paginate(20);

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
