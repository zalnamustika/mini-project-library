<?php

namespace App\Services;

class CirculationStore
{
    public function loans(): array
    {
        return config('dummy_library.loans', []);
    }

    public function borrow(string $userId, string $bookId): array
    {
        // V2 circulation hanya urus transaksi; validasi buku bisa dilakukan di catalog pada sistem nyata.
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

        if (!$loan) return ['ok' => false, 'error' => 'LOAN_NOT_FOUND'];
        if (($loan['status'] ?? '') === 'RETURNED') return ['ok' => false, 'error' => 'ALREADY_RETURNED'];

        return ['ok' => true, 'data' => ['loan_id' => $loanId, 'status' => 'RETURNED']];
    }
}
