<?php

namespace Tests\Feature;

use Tests\TestCase;

class LibraryApiTest extends TestCase
{
    public function test_search_books_returns_200_and_data(): void
    {
        $res = $this->getJson('/api/books?q=martin');

        $res->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    '*' => ['id','title','author','available_stock'],
                ],
            ]);
    }

    public function test_borrow_validation_error(): void
    {
        $res = $this->postJson('/api/borrow', []);
        $res->assertStatus(422);
    }

    public function test_borrow_book_not_found(): void
    {
        $res = $this->postJson('/api/borrow', [
            'user_id' => 'U001',
            'book_id' => 'B999',
        ]);

        $res->assertStatus(400)
            ->assertJson(['error' => 'BOOK_NOT_FOUND']);
    }

    public function test_return_loan_not_found(): void
    {
        $res = $this->postJson('/api/return', [
            'loan_id' => 'L999',
        ]);

        $res->assertStatus(400)
            ->assertJson(['error' => 'LOAN_NOT_FOUND']);
    }
}
