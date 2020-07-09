<?php

namespace App\Http\Controllers;

use App\UserType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
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
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.email_verified_at',
                'users.created_at',
                'users.updated_at',
                'user_types.type'
            )
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
        $data = $request->validate(
            [
                'name' => 'bail|required|max:32',
                'user_type_id' => 'bail|required|exists:user_types,id',
                'email' => 'bail|required|unique:Users,email',
                'password' => 'bail|required|max:128',
                'confirm_password' => 'bail|required|max:128|same:password'
            ]
        );

        $user = User::create(
            [
                'name' => $data['name'],
                'user_type_id' => $data['user_type_id'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]
        );

        // create user profile
        DB::table('profiles')
            ->insert(
                [
                    'user_id' => $user->id
                ]
            );

        $user->type = DB::table('user_types')
            ->where('id', $user->user_type_id)
            ->value('type');

        $user->password = null;
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
        $user->type = DB::table('user_types')
            ->where('id', $user->user_type_id)
            ->value('type');

        $user->password = null;

        $user->profile = DB::table('profiles')
                            ->where('user_id', $user->id)
                            ->first();

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
        $user->type = DB::table('user_types')
            ->where('id', $user->user_type_id)
            ->value('type');

        $userTypes = UserType::all();

        $user->password = null;
        return view('users.update', compact('user', 'userTypes'));
    }

    public function editType(User $user)
    {
        $user->password = null;

        $user->type = DB::table('user_types')
            ->where('id', $user->user_type_id)
            ->value('type');

        $userTypes = UserType::all();

        return view('users.change_type', compact('user', 'userTypes'));
    }

    /**
     * Update a user's type
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateType(Request $request, User $user)
    {
        $currentUser = Auth::user();
        $adminId = \App\UserType::whereRaw('lower(type) LIKE ?', ['%administrator%'])->value('id');

        if ($user->user_type_id === $adminId &&
            $currentUser->user_type_id !== $adminId
        ) {
            $msg = 'You are not authorised to change this user\'s type';
            $userTypes = UserType::all();
            return view('users.change_type', compact('user', 'userTypes', 'msg'));
        }

        $user->update(
            $request->validate(
                [
                    'user_type_id' => 'bail|required|exists:user_types,id',
                ]
            )
        );

        $user->password = null;

        return redirect(route('users.show', compact('user')));
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
        $currentUser = Auth::user();
        $user->password = null;

        if ($currentUser->id !== $user->id) {
            $msg = 'You are not authorised to update another user\'s details';
            $userTypes = UserType::all();
            return view('users.update', compact('user', 'userTypes', 'msg'));
        }

        if ($request->password !== $request->confirm_password) {
            $msg = 'Passwords do not match';
            $userTypes = UserType::all();
            return view('users.update', compact('user', 'userTypes', 'msg'));
        }

        Validator::make(
            $request->all(),
            [
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
            ]
        );

        $user->update(
            $request->validate(
                [
                    'name' => 'bail|required|max:32',
                    'user_type_id' => 'bail|required|exists:user_types,id',
                    'password' => 'bail|required|max:128'
                ]
            )
        );

        return redirect(route('users.show', compact('user')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $user)
    {
        $currentUser = Auth::user();
        $adminId = \App\UserType::whereRaw('lower(type) LIKE ?', ['%administrator%'])->value('id');

        if ($user->user_type_id === $adminId &&
            $currentUser->user_type_id !== $adminId
        ) {
            $msg = 'You are not authorised to delete this user';
            return view('users.index', compact('msg'));
        }

        try {
            $user->delete();
            return redirect(route('users.index'));
        } catch (\Exception $e) {
            $msg = 'Could not delete user: '.$e->getMessage();
            return redirect(route('users.index', compact($msg)));
        }
    }
}
