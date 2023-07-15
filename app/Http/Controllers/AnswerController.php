<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $answers = Answer::query()
            ->where('user_id', '!=', $request->user()->id)
            ->whereIn('question_id', $request->user()->questions()->pluck('id'))
            ->latest()
            ->get();

        return view('pages.answers.indexAnswers', [
            'answers' => $answers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnswerRequest $request)
    {
        $question = Question::findOrFail($request->get('question_id'));

        abort_if($question->user_id === $request->user()->id, 403);
        abort_if($question->answers()->whereUserId($request->user()->id)->exists(), 403);

        $question->answers()->create([
            'user_id' => $request->user()->id,
            'answer' => $request->get('answer'),
        ]);

        return redirect()->back()->with('status', 'answer-stored');
    }
}
