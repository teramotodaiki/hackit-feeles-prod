<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Invitation;
use App\User;

class InvitationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Invitation::where('expired_at', '<', Carbon::now())->delete();
    }

    public function index()
    {
        if (Invitation::count() === 0) {
            return redirect('/')
                ->with('message', 'Your invitation is expired. Ask administrator to retry.');
        }

        return view('invitation');
    }

    public function store(Request $request)
    {
        if (Invitation::count() === 0) {
            return redirect('/')
                ->with('message', 'Your invitation is expired. Ask administrator to retry.');
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'userid' => 'required|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $invitation = Invitation::first();

        if (isset($invitation)) {
            $user = User::create([
                'name' => $request->input('name'),
                'userid' => $request->input('userid'),
                'password' => bcrypt($request->input('password')),
            ]);
            Auth::login($user);

            $invitation->delete();
        }

        return redirect('/home');
    }

}
