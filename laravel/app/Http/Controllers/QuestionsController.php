<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $questions = Question::with('user')->latest()->paginate(5);
        return view('questions.index')->with('questions', $questions);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question =new Question();
        return view('questions.create')->with('question',$question);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title','body'));
        return redirect()->route('questions.index')->with('success','Your Question has been submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views'); // it is same as this ==>>> $question->views=$question->views +1 ; $question->save();
        return view('questions.show')->with('question',$question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        // if(\Gate::denies('update-question',$question)){
        //     abort(403,'Access denied');
        // } //from lesson-12-a
        $this->authorize("update",$question); //from lesson-12-b
        return view('questions.edit')->with('question',$question);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        // if(\Gate::denies('update-question',$question)){
        //     abort(403,'Access denied');
        // } //from lesson-12-a
        $this->authorize("update",$question); //from lesson-12-b
        $question->update($request->only('title','body'));
        return redirect()->route('questions.index')->with('success','Your Question has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // if(\Gate::denies('delete-question',$question)){
        //     abort(403,'Access denied');
        // } // from lesson-12-a
        $this->authorize("delete",$question); //from lesson-12-b
        $question->delete();
        return redirect('/questions')->with('success','Your Question has been Deleted');
    }
}
