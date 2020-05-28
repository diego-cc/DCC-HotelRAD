@extends('layouts.app')
@section('title')
    Feedback Subjects: Browse
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="text-center mb-5">All feedback subjects</h1>

        <div class="text-center mb-5">
            <a href="{{route('feedback_subjects.create')}}" class="btn btn-lg btn-primary">Add a new feedback
                subject</a>
        </div>

        @if (count($fs) < 1)
            <p class="lead text-center">No feedback subjects available</p>
        @endif

        @if (count($fs) > 0)
            <table class="table table-hover table-responsive-sm">
                <thead class="thead-dark">
                <tr>
                    <th class="text-center" scope="col">ID</th>
                    <th class="text-center" scope="col">Subject</th>
                    <th class="text-center" scope="col">Description</th>
                    <th class="text-center" scope="col">Date created</th>
                    <th class="text-center" scope="col">Date updated</th>
                    <th class="text-center" scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fs as $feedbackSubject)
                    <tr>
                        <th class="text-center" scope="row">{{$feedbackSubject->id}}</th>
                        <td class="text-center font-weight-bold">{{$feedbackSubject->subject}}</td>
                        <td class="text-center">{{$feedbackSubject->description}}</td>
                        <td class="text-center">{{\Carbon\Carbon::parse($feedbackSubject->created_at)->isoFormat('LLLL')}}</td>
                        <td class="text-center">{{$feedbackSubject->updated_at ? \Carbon\Carbon::parse($feedbackSubject->updated_at)->isoFormat('LLLL') : 'Never'}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('feedback_subjects.show', $feedbackSubject)}}"
                                   class="btn btn-info mr-4">View</a>
                                <a href="{{route('feedback_subjects.edit', $feedbackSubject)}}"
                                   class="btn btn-warning mr-4">Edit</a>
                                @includeIf('utils.delete', ['resource' => $feedbackSubject, 'type' => 'feedbackSubject'])
                                <button class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete-resource-{{$feedbackSubject->id}}">Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
