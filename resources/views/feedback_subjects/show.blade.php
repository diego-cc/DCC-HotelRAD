@extends('layouts.app')
@section('title')
    Feedback subjects: Read
@endsection

@section('styles')
    <link href="/css/rates/show.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Viewing details of a feedback subject with ID: {{$feedbackSubject->id}}</h1>

        <div class="container">
            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">ID:</p>
                <p class="font-weight-bolder">{{$feedbackSubject->id}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Subject:</p>
                <p class="font-weight-bold">{{$feedbackSubject->subject}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Description:</p>
                <p>{{$feedbackSubject->description}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Date created:</p>
                <p>{{\Carbon\Carbon::parse($feedbackSubject->created_at)->isoFormat('LLLL')}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center mb-4">
                <p class="mr-2">Date updated:</p>
                <p>
                    {{$feedbackSubject->updated_at ? \Carbon\Carbon::parse($feedbackSubject->updated_at)->isoFormat('LLLL') : 'Never'}}
                </p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <a href="{{route('feedback_subjects.edit', $feedbackSubject)}}" class="btn btn-warning mr-5">Edit</a>

                @includeIf('utils.delete', ['type' => 'feedbackSubject', 'resource'=> $feedbackSubject])
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete-resource-{{$feedbackSubject->id}}">Delete</button>
            </div>

            <div class="d-flex justify-content-center _browse-all-btn">
                <a href="{{route('feedback_subjects.index')}}" class="text-info h5">Browse all feedback subjects</a>
            </div>
        </div>
    </div>
@endsection
