<?php

namespace App\Http\Controllers;

use App\UserType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $userTypes = DB::table('user_types')
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

        return view('user_types.index', compact('userTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('user_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return View
     */
    public function store(Request $request)
    {
        $ut = $request->validate(
            [
                'type' => 'bail|required|max:128',
                'description' => 'bail|max:255',
                'icon' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );

        $userType = new UserType;

        if ($request->file('icon')) {
            $icon = $request->icon->store('icons');
            $userType->icon = $icon;
        }

        $userType->type = $ut['type'];
        $userType->description = $ut['description'];

        $userType->save();

        return view('user_types.show', compact('userType'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserType  $userType
     * @return View
     */
    public function show(UserType $userType)
    {
        return view('user_types.show', compact('userType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserType  $userType
     * @return View
     */
    public function edit(UserType $userType)
    {
        return view('user_types.update', compact('userType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserType  $userType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, UserType $userType)
    {
        $request->validate(
            [
                'description' => 'bail|max:255',
                'icon' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );

        if ($request->file('icon')) {
            $icon = $request->icon->store('icons');
            $request->icon = $icon;

            // delete old icon
            Storage::delete($userType->icon);
        }

        $userType->update(
            [
                'icon' => $request->icon,
                'description' => $request->description
            ]
        );

        return view('user_types.show', compact('userType'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserType  $userType
     * @return RedirectResponse
     */
    public function destroy(UserType $userType)
    {
        // delete icon
        Storage::delete($userType->icon);
        $userType->delete();

        return redirect()->route('user_types.index')->with('success', 'UsersController type successfully deleted');
    }
}
