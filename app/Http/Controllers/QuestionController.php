<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionReqest;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('edit', 'create', 'store', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('questions.index', [
            'questions' => Question::with('user')->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();
        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        // priamo do userovych questions vytvorime dalsi question, vdaka vztahom v user modely (hasMany)
        auth()->user()->questions()->create( $request->all() );

        return redirect()->route('questions.index')->with('success', 'Questions added.');
    }


    /**
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Question $question)
    {
        $question->increment('views');
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $question = Question::whereSlug($slug)->firstOrFail();
        // Authorization
        $this->authorize('update', $question);

        return view('questions.edit', compact('question'));
    }


    /**
     * @param Request $request
     * @param Question $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $question = Question::whereSlug($id)->firstOrFail();
        // Authorization
        $this->authorize('update', $question);

        $question->update( $request->all() );

        return redirect()->route('questions.index')->with('success', 'Questions updated.');

    }


    public function destroy($lug)
    {
        $question = Question::whereSlug($lug)->firstOrFail();
        // Authorization
        $this->authorize('delete', $question);

        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Questions deleted.');
    }
}
