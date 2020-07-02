@extends('layouts.app')
@section('title')
    Rates: Browse
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="text-center mb-5">All rates</h1>

        <div class="text-center mb-5">
            <a href="{{route('rates.create')}}" class="btn btn-lg btn-primary">Add a new rate</a>
        </div>

        @if (count($rates) < 1)
            <p class="lead text-center">No rates available</p>
        @endif

        @if (count($rates) > 0)
            <table class="table table-hover table-responsive-sm">
                <thead class="thead-dark">
                <tr>
                    <th class="text-center" scope="col">ID</th>
                    <th class="text-center" scope="col">Rate</th>
                    <th class="text-center" scope="col">Description</th>
                    <th class="text-center" scope="col">Date created</th>
                    <th class="text-center" scope="col">Date updated</th>
                    <th class="text-center" scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rates as $rate)
                    <tr>
                        <th class="text-center" scope="row">{{$rate->id}}</th>
                        <td class="text-center text-success font-weight-bold">&#36; {{$rate->rate}}</td>
                        <td class="text-center">{{$rate->description}}</td>
                        <td class="text-center">{{\Carbon\Carbon::parse($rate->created_at)->isoFormat('LLLL')}}</td>
                        <td class="text-center">{{$rate->updated_at ? \Carbon\Carbon::parse($rate->updated_at)->isoFormat('LLLL') : 'Never'}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('rates.show', $rate->id)}}" class="btn btn-info mr-4">View</a>
                                <a href="{{route('rates.edit', $rate->id)}}" class="btn btn-warning mr-4">Edit</a>
                                @includeIf('utils.delete', ['resource' => $rate, 'type' => 'rate'])
                                <button class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete-resource-{{$rate->id}}">Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-5">
                {{ $rates->links() }}
            </div>

        @endif
    </div>
@endsection
