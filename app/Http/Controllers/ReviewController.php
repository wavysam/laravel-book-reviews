<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book): View
    {
        return view('books.reviews.create',['book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book): RedirectResponse
    {
        $payload = $request->validate([
            'review' => 'required|string',
            'rating' => 'required|integer'
        ]);

        $book->reviews()->create([
            'review' => $request->review,
            'rating' => $request->rating
        ]);

        return redirect()->route('books.show', $book);
    }
}
