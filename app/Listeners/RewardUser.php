<?php

namespace App\Listeners;

use App\Events\UserReferred;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RewardUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserReferred $event): void
    {
        //
        $referral = \App\Models\ReferralLink::find($event->referralId);
        if (!is_null($referral)) {

            \App\Models\ReferralRelationship::create(['referral_link_id' => $referral->id, 'user_id' => $event->user->id]);

            // Example...
            if ($referral->program->name === 'Sign-up Bonus') {
                // User who was sharing link
                $provider = $referral->user;
                //$provider->addCredits(15);
                $provider->addPoints(15);
                // User who used the link
                $user = $event->user;
                //$user->addCredits(20);
                $user->addPoints(20);
                //Level Up Add Points

            }

        }
    }
}
