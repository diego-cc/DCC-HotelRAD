<?php

namespace App\Http\Controllers;

use App\RoomStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class RoomStatusesController Handles /room_statuses endpoints
 * @package App\Http\Controllers
 */
class RoomStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        // get all room statuses, sorted by latest updated
        $roomStatuses = RoomStatus::orderBy('updated_at', 'desc')->get();

        // Display all room statuses (index.blade.php)
        return view('room_statuses.index', compact('roomStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        // View form to add a new room status (create.blade.php)
        return view('room_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return View
     */
    public function store(Request $request)
    {
        // validate and add a new room status
        $roomStatus = RoomStatus::create(
            $request->validate(
                [
                    'name' => 'bail|required|max:16',
                    'description' => 'bail|required|max:255'
                ]
            )
        );

        // show new room status (show.blade.php)
        return view('room_statuses.show', compact('roomStatus'));
    }

    /**
     * Display the specified resource.
     *
     * @param  RoomStatus  $roomStatus
     * @return View
     */
    public function show(RoomStatus $roomStatus)
    {
        // Read (show.blade.php)
        return view('room_statuses.show', compact('roomStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RoomStatus  $roomStatus
     * @return View
     */
    public function edit(RoomStatus $roomStatus)
    {
        // View form to edit a room status
        return view('room_statuses.update', compact('roomStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  RoomStatus  $roomStatus
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, RoomStatus $roomStatus)
    {
        // validate and update room status
        $roomStatus->update(
            $request->validate(
                [
                    'name' => 'bail|required|max:16',
                    'description' => 'bail|required|max:255'
                ]
            )
        );

        // redirect to updated room status
        return redirect(route('room_statuses.show', $roomStatus));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RoomStatus  $roomStatus
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(RoomStatus $roomStatus)
    {
        // Delete a room status
        try {
            $roomStatus->delete();
        } catch (\Exception $e) {
            // TODO: handle this case (e.g. resource not found or could not connect to database)
            dd($e);
        } finally {
            return redirect(route('room_statuses.index'));
        }
    }
}
