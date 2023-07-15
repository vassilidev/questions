<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $question = Question::query()
            ->with('user:id,name')
            ->whereNotIn('user_id', [$request->user()->id])
            ->whereDoesntHave('answers', function ($query) use ($request) {
                $query->whereIn('user_id', [$request->user()->id]);
            })
            ->inRandomOrder()
            ->first();

        return view('pages.dashboard', [
            'question' => $question
        ]);
    }
}
