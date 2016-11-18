<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUser;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('uploader:thumbnail')->only('update');
        // $this->middleware('admin')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(25);

        return view('users/index', ['users' => $users]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $contents = $user->contents()
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('users/profile', [
            'user' => $user,
            'contents' => $contents
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users/edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'string|max:255',
            'password_current' => 'required_with:password',
            'password' => 'sometimes|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);
        if ($user->id !== $request->user()->id) {
            return response('Forbidden', 403);
        }

        if ($request->has('password')) {
            if (!password_verify($request->input('password_current'), $user->password)) {
                return redirect()
                    ->route('users.edit', [$user])
                    ->with('status', 'danger')
                    ->with('message', 'Password inncorrect!!!');
            }

            $user->password = bcrypt($request->input('password'));
        }
        if ($request->hasFile('thumbnail')) {
            $user->thumbnail = $request->uploaded->thumbnail;
        }
        $user->save();

        $user->update(
            $request->except(['userid', 'email', 'password'])
        );

        return redirect()
            ->route('users.edit', [$user])
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
