<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CirculationStore;
use Illuminate\Http\Request;

class CirculationController extends Controller
{
    public function __construct(private CirculationStore $store) {}

    public function loans()
    {
        return response()->json([
            'status' => 200,
            'data' => $this->store->loans(),
        ], 200);
    }

    public function borrow(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|string',
            'book_id' => 'required|string',
        ]);

        $result = $this->store->borrow($validated['user_id'], $validated['book_id']);

        return response()->json([
            'status' => 201,
            'data' => $result['data'],
        ], 201);
    }

    public function returnBook(Request $request)
    {
        $validated = $request->validate([
            'loan_id' => 'required|string',
        ]);

        $result = $this->store->returnBook($validated['loan_id']);

        if (!$result['ok']) {
            return response()->json(['status' => 400, 'error' => $result['error']], 400);
        }

        return response()->json(['status' => 200, 'data' => $result['data']], 200);
    }
}
