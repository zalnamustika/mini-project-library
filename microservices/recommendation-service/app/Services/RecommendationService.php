<?php

namespace App\Services;

class RecommendationService
{
    public function recommend(array $allBooks, array $searchedBooks, int $limit = 3): array
    {
        // Rekomendasi sederhana: jika user search "martin", buku dengan author "martin" muncul dulu.
        // (Biar gampang demo; bisa kamu kembangkan jadi tag-based kalau mau)
        $preferredAuthors = [];
        foreach ($searchedBooks as $b) {
            $author = trim((string)($b['author'] ?? ''));
            if ($author !== '') $preferredAuthors[strtolower($author)] = true;
        }

        if (!$preferredAuthors) return array_slice($allBooks, 0, $limit);

        $scored = [];
        foreach ($allBooks as $b) {
            $authorLower = strtolower((string)($b['author'] ?? ''));
            $score = isset($preferredAuthors[$authorLower]) ? 10 : 0;
            $scored[] = ['book' => $b, 'score' => $score];
        }

        usort($scored, fn($a,$b) => $b['score'] <=> $a['score']);

        return array_slice(array_map(fn($x) => $x['book'], $scored), 0, $limit);
    }
}
