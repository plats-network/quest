<?php

namespace App\Traits;

use App\Notifications\SendVerifyTelegram;

trait MustVerifyTelegram
{
    public function hasVerifiedTelegram(): bool
    {
        return ! is_null($this->telegram_verified_at);
    }

    public function markTelegramAsVerified(): bool
    {
        return $this->forceFill([
            'telegram_verified_at' => $this->freshTimestamp(),
            'telegram_attempts_left' => 0,
        ])->save();
    }

    public function sendTelegramVerificationNotification(): void
    {
        $this->notify(new SendVerifyTelegram());
    }
}
