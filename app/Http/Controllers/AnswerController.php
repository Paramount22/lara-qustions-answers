<?php

namespace App\Http\Controllers;
use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Question $question)
    {

        return $question->answers()->with('user')->simplePaginate(3);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $question->answers()->create($request->validate([
                'body' => 'required'
            ]) + ['user_id' => auth()->id()]);

        return back()->with('success', "Your answer has been submitted successfully");
    }


    /**
     * @param Question $question
     * @param Answer $answer
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        return view('answers.edit', compact('question', 'answer'));
    }


    /**
     * @param Request $request
     * @param Question $question
     * @param Answer $answer
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
       $this->authorize('update', $answer);
        $answer->update($request->validate([
            'body' => 'required'
        ]));

        if($request->expectsJson() ) {
            return response()->json([
                'message' => 'Your answer has been updated',
                'body_html' => $answer->body_html
        ]);
        }
        return redirect()->route('questions.show', $question->slug)
            ->with('success', 'Your answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);

        $answer->delete();

        if(request()->expectsJson() ) {
            return response()->json([
                'message' => 'Your answer has been deleted',

            ]);
        }

        return back()->with('success', 'Your answer has been deleted.');
    }
}
