<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->post('/books', [
                'title' => 'Cool Book Title',
                'author' => 'Victor Frankenstien'
        ]);
        $response->assertOk();

        $this->assertCount(1, Book::all());
    }

    /**
     * @test
     */
    public function a_title_is_required()
    {
        $response = $this->post('/books', [
                'title' => '',
                'author' => 'Victor Frankenstien'
        ]);
        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function a_author_is_required()
    {
        $response = $this->post('/books', [
                'title' => 'Cool Book Title',
                'author' => '',
        ]);
        $response->assertSessionHasErrors('author');
    }

    /**
     * @test
     */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'Victor Frankenstien'
        ]);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id, [
            'title' => 'New title',
            'author' => 'New Author',
        ]);

        $this->assertEquals('New title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
    }
}
