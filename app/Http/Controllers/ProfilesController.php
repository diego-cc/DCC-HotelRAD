<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return View
     */
    public function show(Profile $profile)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  \App\Profile  $profile
     * @return View
     */
    public function edit(Request $request, Profile $profile)
    {
        $associatedUser = User::where('id', $profile->user_id)->first();
        $associatedUser->type = UserType::where('id', $associatedUser->user_type_id)->value('type');
        $associatedUser->password = null;

        $profile->user = $associatedUser;

        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Profile $profile)
    {
        $data = $request->validate(
            [
                'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'given_name' => 'nullable|max:128',
                'family_name' => 'nullable|max:128',
                'dob' => 'nullable|date_format:Y-m-d|before:today'
            ]
        );

        if ($request->file('pic')) {
            $pic = $request->pic->store('pics');
            $request->pic = $pic;

            // delete old profile pic
            Storage::delete($profile->pic);
        }

        if ($profile->remove_pic) {
            // delete current profile pic
            Storage::delete($profile->pic);
            $profile->pic = null;
        }

        DB::table('profiles')
            ->where('user_id', $profile->user_id)
            ->update(
                [
                    'pic' => $request->pic ?? $profile->pic,
                    'given_name' => $data['given_name'],
                    'family_name' => $data['family_name'],
                    'dob' => $data['dob'],
                    'remove_pic' => false
                ]
            );

        $profile = $this->mapUser($profile);

        return redirect(route('profiles.edit', compact('profile')))->with('msg', 'Profile updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }

    public function togglePic(Request $request, Profile $profile)
    {
        $data = $request->validate(
            [
                'user_id' => 'bail|required|exists:users,id',
                'remove_pic' => 'bail|required|boolean'
            ]
        );

        $profile->update(
            [
                'remove_pic' => $data['remove_pic']
            ]
        );

        return response()->json(
            [
                'remove_pic' => $profile->remove_pic,
                'status' => 200
            ]
        );
    }

    /**
     * Maps the corresponding user to $profile, including all of its properties plus type
     * @param  Profile  $profile
     * @return Profile
     */
    public function mapUser(Profile $profile)
    {
        $associatedUser = User::where('id', $profile->user_id)->first();
        $associatedUser->type = UserType::where('id', $associatedUser->user_type_id)->value('type');
        $associatedUser->password = null;

        $profile->user = $associatedUser;

        return $profile;
    }
}
