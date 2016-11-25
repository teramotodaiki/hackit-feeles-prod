<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentLoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    /**
     * userid によって認証を処理する
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'userid' => 'required|max:255',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt([
            'userid' => $request->input('userid'),
            'password' => $request->input('password')
        ], $request->has('remember'))) {
            // 認証に成功した
            return redirect()->intended('home');
        } else {
            return back()->withInput()
                ->with('status', 'danger')
                ->with('message', trans('form.login_failed'));
        }
    }
}
