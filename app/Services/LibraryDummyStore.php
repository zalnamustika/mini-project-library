<?php

namespace App\Services;

class LibraryDummyStore
{
    public function books(): array
    {
        return config('dummy_library.books', []);
    }

    public function loans(): array
    {
        return config('dummy_library.loans', []);
    }

    public function searchBooks(?string $q): array
    {
        $q = trim((string) $q);
        $books = $this->books();

        if ($q === '') return $books;

        $qLower = mb_strtolower($q);

        return array_values(array_filter($books, function ($b) use ($qLower) {
            return str_contains(mb_strtolower($b['title']), $qLower)
                || str_contains(mb_strtolower($b['author']), $qLower);
        }));
    }

    public function borrow(string $userId, string $bookId): array
    {
        $book = null;
        foreach ($this->books() as $b) {
            if ($b['id'] === $bookId) { $book = $b; break; }
        }

        if (!$book) {
            return ['ok' => false, 'error' => 'BOOK_NOT_FOUND'];
        }

        if (($book['available_stock'] ?? 0) < 1) {
            return ['ok' => false, 'error' => 'OUT_OF_STOCK'];
        }

        // Dummy: tidak update stock sungguhan (karena config statis)
        return [
            'ok' => true,
            'data' => [
                'loan_id' => 'L' . rand(100, 999),
                'user_id' => $userId,
                'book_id' => $bookId,
                'status' => 'BORROWED',
            ],
        ];
    }

    public function returnBook(string $loanId): array
    {
        $loan = null;
        foreach ($this->loans() as $l) {
            if ($l['id'] === $loanId) { $loan = $l; break; }
        }

        if (!$loan) {
            return ['ok' => false, 'error' => 'LOAN_NOT_FOUND'];
        }

        if (($loan['status'] ?? '') === 'RETURNED') {
            return ['ok' => false, 'error' => 'ALREADY_RETURNED'];
        }

        // Dummy: tidak update loan sungguhan
        return [
            'ok' => true,
            'data' => [
                'loan_id' => $loanId,
                'status' => 'RETURNED',
            ],
        ];
    }
}
