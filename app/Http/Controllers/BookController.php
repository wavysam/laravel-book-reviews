<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $title = $request->input('title');
        $filter = $request->input('filter', '');

        $books = Book::when($title, fn($query, $title) => $query->title($title));

        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_six_months' => $books->popularLastSixMonths(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_six_months' => $books->highestRatedLastSixMonths(),
            default => $books->latest()->withCount('reviews')->withAvg('reviews', 'rating')
        };

        $books = $books->get();

        return view('books.index', ['books' => $books]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): View
    {
        return view('books.show', [
            'book' => $book->load([
                'reviews' => fn ($query) => $query->latest()
            ])->loadAvg('reviews', 'rating')->loadCount('reviews'),
        ]);
    }
}
