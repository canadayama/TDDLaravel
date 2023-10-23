<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BooksController extends Controller
{
    /**
     * 
     */
    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required',
        ]);
    }

    /**
     * 
     */
    public function store()
    {
        $book = Book::create($this->validateRequest());

        return redirect($book->path());
    }

    /**
     * 
     */
    public function update(Book $book)
    {
        $book->update($this->validateRequest());

        return redirect($book->path());
    }

    /**
     * @param Book book
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books');
    }
}
