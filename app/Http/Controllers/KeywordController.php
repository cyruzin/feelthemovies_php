<?php

namespace App\Http\Controllers;

use App\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function index()
    {
        try {
            return response()->json(Keyword::paginate(30));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            return response()->json(Keyword::find($id), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        try {
            return response()->json(Keyword::create($request->all(), 201));
        } catch (\Exception  $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required']);

        try {
            $rec = Keyword::findOrFail($id);
            $rec->update($request->all());

            return response()->json($rec, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function delete($id)
    {
        try {
            Keyword::findOrFail($id)->delete();
            return response()->json(['message' => 'Deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

}
