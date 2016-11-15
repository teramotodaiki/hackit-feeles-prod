<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Invitation;

class AdminController extends Controller
{
    public function invite(Request $request)
    {
        $this->validate($request, [
            'num' => 'required|numeric|min:1'
        ]);

        Invitation::where('expired_at', '<', Carbon::now())->delete();

        DB::table('invitations')->insert(
            array_fill(0, $request->input('num'), [
                'created_at' => Carbon::now(),
                'expired_at' => Carbon::now()
                    ->addSeconds(env('INVITATION_EXPIRED', 60)),
            ])
        );

        return redirect('/admin');
    }

    public function discardInvitation()
    {
        Invitation::orderBy('id')->delete();

        return redirect('/admin');
    }
}
