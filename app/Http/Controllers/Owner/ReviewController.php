<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $ownerId = auth()->id();
        $reviews = Review::whereHas('property', function ($query) use ($ownerId) {
            $query->where('user_id', $ownerId);
        })->with(['user', 'property'])->latest()->get();

        return view('owner.reviews.index', compact('reviews'));
    }
}