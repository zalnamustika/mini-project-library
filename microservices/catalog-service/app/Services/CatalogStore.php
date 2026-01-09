<?php

namespace App\Services;

class CatalogStore
{
    public function books(): array
    {
        return config('dummy_library.books', []);
    }

    public function search(?string $q): array
    {
        $q = trim((string)$q);
        $books = $this->books();
        if ($q === '') return $books;

        $qLower = mb_strtolower($q);
        return array_values(array_filter($books, function($b) use ($qLower) {
            return str_contains(mb_strtolower($b['title']), $qLower)
                || str_contains(mb_strtolower($b['author']), $qLower);
        }));
    }
}
