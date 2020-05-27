<?php
/**********************************************************
 * Package: ${PACKAGE_NAME}
 * Project: dcc-hotelrad
 * File:
 * Author: Diego <20026893@tafe.wa.edu.au>
 * Date: 2020-05-28
 * Version: 1.0.0
 * Description: add short description of file's purpose
 **********************************************************/
?>

<div class="modal fade" tabindex="-1" role="dialog" id="delete-rate-{{$rate->id}}" aria-labelledby="deleteRateModal">
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
                    <p class="list-group-item">Rate ID: <span class="font-weight-bolder">{{$rate->id}}</span></p>
                    <p class="list-group-item">Rate: <span class="text-success font-weight-bold">&#36; {{$rate->rate}}</span></p>
                    <p class="list-group-item">Description: {{$rate->description}}</p>
                    <p class="list-group-item">Date created: {{\Carbon\Carbon::parse($rate->created_at)->isoFormat('LLLL')}}</p>
                    <p class="list-group-item">Date updated: {{$rate->updated_at ? \Carbon\Carbon::parse($rate->updated_at)->isoFormat('LLLL') : 'Never'}}</p>
                </div>
                <h5 class="mb-3">Are you sure?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                <form action="{{route('rates.destroy', $rate)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
