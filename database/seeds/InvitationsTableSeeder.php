<?php

use Illuminate\Database\Seeder;
use App\Invitation;
use Carbon\Carbon;

class InvitationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invitation::create([
            'expired_at' => Carbon::now()
                ->addSeconds(env('INVITATION_EXPIRED', 60)),
        ]);
    }
}
