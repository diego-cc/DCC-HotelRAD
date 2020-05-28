<?php

namespace App\Http\Controllers;

use App\FeedbackSubject;
use Illuminate\Http\Request;

class FeedbackSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all feedback subjects, sorted by latest
        $fs = FeedbackSubject::orderBy('updated_at', 'desc')->get();

        // display subjects
        return view('feedback_subjects.index', compact('fs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // View form to add a new feedback subject (create.blade.php)
        return view('feedback_subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate and add a new feedback subject
        $feedbackSubject = FeedbackSubject::create($request->validate([
                                                    'subject' => 'bail|required|max:24',
                                                    'description' => 'bail|required|max: 255'
                                                ]));

        // show new feedback subject (show.blade.php)
        return view('feedback_subjects.show', compact('feedbackSubject'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FeedbackSubject  $feedbackSubject
     * @return \Illuminate\Http\Response
     */
    public function show(FeedbackSubject $feedbackSubject)
    {
        // Read (show.blade.php)
        return view('feedback_subjects.show', compact('feedbackSubject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FeedbackSubject  $feedbackSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(FeedbackSubject $feedbackSubject)
    {
        // View form to edit a feedback subject
        return view('feedback_subjects.update', compact('feedbackSubject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FeedbackSubject  $feedbackSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeedbackSubject $feedbackSubject)
    {
        // validate and update rate
        $feedbackSubject->update(
            $request->validate(
                [
                    'subject' => 'bail|required|max:24',
                    'description' => 'bail|required|max: 255'
                ]
            )
        );

        // redirect to updated rate
        return redirect(route('feedback_subjects.show', $feedbackSubject));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FeedbackSubject  $feedbackSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeedbackSubject $feedbackSubject)
    {
        // Delete a rate
        try {
            $feedbackSubject->delete();
        }
        catch(\Exception $e) {
            // TODO: handle this case (e.g. rate not found or could not connect to database)
            dd($e);
        } finally {
            return redirect(route('feedback_subjects.index'));
        }
    }
}
