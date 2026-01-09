<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CatalogStore;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function __construct(private CatalogStore $store) {}

    public function books(Request $request)
    {
        return response()->json([
            'status' => 200,
            'data' => $this->store->search($request->query('q')),
        ], 200);
    }
}
