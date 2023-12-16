@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">Add Review for
        <span class="font-semibold">
            {{ $book->title }}
        </span>
        </h1>

    <form action="{{ route('books.reviews.store', $book) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="review">Review</label>
            <textarea name="review" id="review" class="input">{{ old('review') }}</textarea>
            <x-input-error field="review" />
        </div>

        <div class="mb-4">
            <label for="rating">Rating</label>
            <select name="rating" id="rating" class="input">
                <option value="">Select a rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <x-input-error field="rating" />
        </div>

        <div>
            <button type="submit" class="btn">Add Review</button>
        </div>
    </form>
@endsection
