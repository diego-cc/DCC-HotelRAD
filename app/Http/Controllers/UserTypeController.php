<?php

namespace App\Http\Controllers;

use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserTypeController extends Controller
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
     * @param  \App\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function show(UserType $userType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function edit(UserType $userType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserType $userType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserType $userType)
    {
        //
    }
}
