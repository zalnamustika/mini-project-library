<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RecommendationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecommendationController extends Controller
{
    public function __construct(private RecommendationService $reco) {}

    public function recommendations(Request $request)
    {
        $q = (string) $request->query('q', '');

        $catalogUrl = rtrim((string) env('CATALOG_URL'), '/');
        if ($catalogUrl === '') {
            return response()->json(['status' => 500, 'error' => 'CATALOG_URL_NOT_SET'], 500);
        }

        // ambil hasil search
        $searchedResp = Http::get($catalogUrl . '/api/books', ['q' => $q]);
        if (!$searchedResp->ok()) {
            return response()->json(['status' => 502, 'error' => 'CATALOG_UNAVAILABLE'], 502);
        }
        $searched = $searchedResp->json('data') ?? [];

        // ambil semua buku
        $allResp = Http::get($catalogUrl . '/api/books');
        if (!$allResp->ok()) {
            return response()->json(['status' => 502, 'error' => 'CATALOG_UNAVAILABLE'], 502);
        }
        $allBooks = $allResp->json('data') ?? [];

        $recoBooks = $this->reco->recommend($allBooks, $searched, 3);

        return response()->json([
            'status' => 200,
            'data' => $recoBooks,
        ], 200);
    }
}
