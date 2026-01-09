<?php

return [
    'books' => [
        [
            'id' => 'B001',
            'title' => 'Clean Code',
            'author' => 'Robert C. Martin',
            'tags' => ['software', 'clean-code'],
            'available_stock' => 3,
        ],
        [
            'id' => 'B002',
            'title' => 'Refactoring',
            'author' => 'Martin Fowler',
            'tags' => ['software', 'refactoring'],
            'available_stock' => 2,
        ],
        [
            'id' => 'B003',
            'title' => 'Design Patterns',
            'author' => 'GoF',
            'tags' => ['software', 'architecture'],
            'available_stock' => 1,
        ],
    ],

    'loans' => [
        [
            'id' => 'L001',
            'user_id' => 'U001',
            'book_id' => 'B002',
            'loan_date' => '2026-01-05',
            'due_date' => '2026-01-12',
            'return_date' => null,
            'status' => 'BORROWED', // BORROWED | RETURNED
        ],
    ],
];
