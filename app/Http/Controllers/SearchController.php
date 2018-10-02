<?php

namespace App\Http\Controllers;

use ApiHelper;
use App\Recommendation;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;
        $keywords = (!empty($request->keywords)) ? array_filter($request->keywords) : '';
        $genres = (!empty($request->genres)) ? array_filter($request->genres) : '';

        if (empty($search) && empty($keywords) && empty($genres)) {
            return response()->json(['message' => 'All fields are empty.'], 400);
        }

        try {
            $rec = Recommendation::with(['keywords', 'genres']);

            if (!empty($request->search)) {
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

}
