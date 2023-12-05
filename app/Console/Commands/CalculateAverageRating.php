<?php

namespace App\Console\Commands;

use App\Models\Course;
use Illuminate\Console\Command;

class CalculateAverageRating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-average-rating';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command recalculates the average rating for courses based on user reviews.';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle(): void
    {
        $chunkSize = 100;

        $query = Course::with('reviews')->whereHas('reviews', function ($query) {
            $query->whereNotNull('rating');
        });
        $query->chunk($chunkSize, function ($coursesToUpdate) {
            foreach ($coursesToUpdate as $course) {
                $newAvgRating = $course->reviews->avg('rating');

                if ($newAvgRating !== $course->average_rating) {
                    $course->update(['average_rating' => $newAvgRating]);
                }
            }
        });
    }
}
