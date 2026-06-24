<?php

namespace App\Services;

use App\Models\Review;

class ReviewService
{
    public function storeReview(array $data, int $userId): Review
    {
        return Review::create([
            'user_id' => $userId,
            'property_id' => $data['property_id'],
            'rating' => $data['rating'],
            'komentar' => $data['komentar'],
        ]);
    }
}