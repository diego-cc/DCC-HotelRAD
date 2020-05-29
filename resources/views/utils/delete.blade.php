<?php
/**********************************************************
 * Package: ${PACKAGE_NAME}
 * Project: dcc-hotelrad
 * File: resources/views/utils/delete.blade.php
 * Author: Diego <20026893@tafe.wa.edu.au>
 * Date: 2020-05-28
 * Version: 1.0.0
 * Description: Delete confirmation modal used by all three features
 **********************************************************/

?>

{{--This is the delete modal used by the index and show views of all three features--}}

@switch ($type)
    @case('rate')
    <div class="modal fade" tabindex="-1" role="dialog" id="delete-resource-{{$resource->id}}"
         aria-labelledby="deleteResourceModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="mb-4">You are about to delete this rate:</h5>
                    <div class="list-group list-group-flush mb-4">
                        <p class="list-group-item">Rate ID: <span class="font-weight-bolder">{{$resource->id}}</span>
                        </p>
                        <p class="list-group-item">Rate: <span
                                class="text-success font-weight-bold">&#36; {{$resource->rate}}</span></p>
                        <p class="list-group-item">Description: {{$resource->description}}</p>
                        <p class="list-group-item">Date
                            created: {{\Carbon\Carbon::parse($resource->created_at)->isoFormat('LLLL')}}</p>
                        <p class="list-group-item">Date
                            updated: {{$resource->updated_at ? \Carbon\Carbon::parse($resource->updated_at)->isoFormat('LLLL') : 'Never'}}</p>
                    </div>
                    <h5 class="mb-3">Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                    <form action="{{route('rates.destroy', $resource)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @break

    @case('feedbackSubject')
    <div class="modal fade" tabindex="-1" role="dialog" id="delete-resource-{{$resource->id}}"
         aria-labelledby="deleteResourceModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="mb-4">You are about to delete this feedback subject:</h5>
                    <div class="list-group list-group-flush mb-4">
                        <p class="list-group-item">Feedback Subject ID: <span
                                class="font-weight-bolder">{{$resource->id}}</span></p>
                        <p class="list-group-item">Subject: <span class="font-weight-bold">{{$resource->subject}}</span>
                        </p>
                        <p class="list-group-item">Description: {{$resource->description}}</p>
                        <p class="list-group-item">Date
                            created: {{\Carbon\Carbon::parse($resource->created_at)->isoFormat('LLLL')}}</p>
                        <p class="list-group-item">Date
                            updated: {{$resource->updated_at ? \Carbon\Carbon::parse($resource->updated_at)->isoFormat('LLLL') : 'Never'}}</p>
                    </div>
                    <h5 class="mb-3">Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                    <form action="{{route('feedback_subjects.destroy', $resource)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @break

    @case('roomStatus')
    <div class="modal fade" tabindex="-1" role="dialog" id="delete-resource-{{$resource->id}}"
         aria-labelledby="deleteResourceModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="mb-4">You are about to delete this room status:</h5>
                    <div class="list-group list-group-flush mb-4">
                        <p class="list-group-item">Room status ID: <span
                                class="font-weight-bolder">{{$resource->id}}</span></p>
                        <p class="list-group-item">Name: <span class="font-weight-bold">{{$resource->name}}</span></p>
                        <p class="list-group-item">Description: {{$resource->description}}</p>
                        <p class="list-group-item">Date
                            created: {{\Carbon\Carbon::parse($resource->created_at)->isoFormat('LLLL')}}</p>
                        <p class="list-group-item">Date
                            updated: {{$resource->updated_at ? \Carbon\Carbon::parse($resource->updated_at)->isoFormat('LLLL') : 'Never'}}</p>
                    </div>
                    <h5 class="mb-3">Are you sure?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                    <form action="{{route('room_statuses.destroy', $resource)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @break

    @default
    <h1>Fix the delete modal!!</h1>
@endswitch

