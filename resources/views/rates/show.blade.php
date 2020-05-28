@extends('layouts.app')
@section('title')
    Rates: Read
@endsection

@section('styles')
    <link href="/css/rates/show.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">Viewing details of a rate with ID: {{$rate->id}}</h1>

        <div class="container">
            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">ID:</p>
                <p class="font-weight-bolder">{{$rate->id}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Description:</p>
                <p>{{$rate->description}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Rate:</p>
                <p class="text-success font-weight-bold">&#36; {{$rate->rate}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <p class="mr-2">Date created:</p>
                <p>{{\Carbon\Carbon::parse($rate->created_at)->isoFormat('LLLL')}}</p>
            </div>

            <div class="d-flex flex-row justify-content-center mb-4">
                <p class="mr-2">Date updated:</p>
                <p>
                    {{$rate->updated_at ? \Carbon\Carbon::parse($rate->updated_at)->isoFormat('LLLL') : 'Never'}}
                </p>
            </div>

            <div class="d-flex flex-row justify-content-center">
                <a href="{{route('rates.edit', $rate)}}" class="btn btn-warning mr-5">Edit</a>

                @includeIf('utils.delete')
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete-rate-{{$rate->id}}">Delete</button>
            </div>

            <div class="d-flex justify-content-center _browse-all-btn">
                <a href="{{route('rates.index')}}" class="text-info h5">Browse all rates</a>
            </div>
        </div>
    </div>
@endsection
