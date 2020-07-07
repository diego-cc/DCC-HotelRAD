<?php

namespace App\Http\Controllers;

use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $users = DB::table('users')
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $userTypes = UserType::all();

        return view('users.create', compact('userTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return View
     */
    public function store(Request $request)
    {
        $user = User::create(
            $request->validate(
                [
                    'name' => 'bail|required|max:32',
                    'user_type_id' => 'bail|required|exists:user_types,id',
                    'email' => 'bail|required|unique:User,email',
                    'password' => 'bail|required|max:128'
                ]
            )
        );

        return view('users.show', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return View
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return View
     */
    public function edit(User $user)
    {
        return view('users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, User $user)
    {
        $user->update(
            $request->validate(
                [
                    'name' => 'bail|required|max:32',
                    'user_type_id' => 'bail|required|exists:user_types,id',
                    'email' => 'bail|required|unique:User,email',
                    'password' => 'bail|required|max:128'
                ]
            )
        );

        return redirect(route('users.show', compact('user')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect(route('users.index'));
        }
        catch (\Exception $e) {
            $msg = 'Could not delete user: ' . $e->getMessage();
            return redirect(route('users.index', compact($msg)));
        }
    }
}
