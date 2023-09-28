<?php

declare(strict_types=1);

namespace App\Traits\Bookings;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait BookingScopes
{
    /**
     * Get past bookings.
     */
    public function pastBookings(): MorphMany
    {
        return $this->bookings()
            ->whereNull('canceled_at')
            ->whereNotNull('ends_at')
            ->where('ends_at', '<', now());
    }

    /**
     * Get future bookings.
     */
    public function futureBookings(): MorphMany
    {
        return $this->bookings()
            ->whereNull('canceled_at')
            ->whereNotNull('starts_at')
            ->where('starts_at', '>', now());
    }

    /**
     * Get current bookings.
     */
    public function currentBookings(): MorphMany
    {
        return $this->bookings()
            ->whereNull('canceled_at')
            ->whereNotNull('starts_at')
            ->whereNotNull('ends_at')
            ->where('starts_at', '<', now())
            ->where('ends_at', '>', now());
    }

    /**
     * Get cancelled bookings.
     */
    public function cancelledBookings(): MorphMany
    {
        return $this->bookings()
            ->whereNotNull('canceled_at');
    }

    /**
     * Get bookings starts before the given date.
     */
    public function bookingsStartsBefore(string $date): MorphMany
    {
        return $this->bookings()
            ->whereNull('canceled_at')
            ->whereNotNull('starts_at')
            ->where('starts_at', '<', new Carbon($date));
    }

    /**
     * Get bookings starts after the given date.
     */
    public function bookingsStartsAfter(string $date): MorphMany
    {
        return $this->bookings()
            ->whereNull('canceled_at')
            ->whereNotNull('starts_at')
            ->where('starts_at', '>', new Carbon($date));
    }

    /**
     * Get bookings starts between the given dates.
     */
    public function bookingsStartsBetween(string $startsAt, string $endsAt): MorphMany
    {
        return $this->bookings()
            ->whereNull('canceled_at')
            ->whereNotNull('starts_at')
            ->where('starts_at', '>', new Carbon($startsAt))
            ->where('starts_at', '<', new Carbon($endsAt));
    }

    /**
     * Get bookings ends before the given date.
     */
    public function bookingsEndsBefore(string $date): MorphMany
    {
        return $this->bookings()
            ->whereNull('canceled_at')
            ->whereNotNull('ends_at')
            ->where('ends_at', '<', new Carbon($date));
    }

    /**
     * Get bookings ends after the given date.
     */
    public function bookingsEndsAfter(string $date): MorphMany
    {
        return $this->bookings()
            ->whereNull('canceled_at')
            ->whereNotNull('ends_at')
            ->where('ends_at', '>', new Carbon($date));
    }

    /**
     * Get bookings ends between the given dates.
     */
    public function bookingsEndsBetween(string $startsAt, string $endsAt): MorphMany
    {
        return $this->bookings()
            ->whereNull('canceled_at')
            ->whereNotNull('ends_at')
            ->where('ends_at', '>', new Carbon($startsAt))
            ->where('ends_at', '<', new Carbon($endsAt));
    }

    /**
     * Get bookings cancelled before the given date.
     */
    public function bookingsCancelledBefore(string $date): MorphMany
    {
        return $this->bookings()
            ->whereNotNull('canceled_at')
            ->where('canceled_at', '<', new Carbon($date));
    }

    /**
     * Get bookings cancelled after the given date.
     */
    public function bookingsCancelledAfter(string $date): MorphMany
    {
        return $this->bookings()
            ->whereNotNull('canceled_at')
            ->where('canceled_at', '>', new Carbon($date));
    }

    /**
     * Get bookings cancelled between the given dates.
     */
    public function bookingsCancelledBetween(string $startsAt, string $endsAt): MorphMany
    {
        return $this->bookings()
            ->whereNotNull('canceled_at')
            ->where('canceled_at', '>', new Carbon($startsAt))
            ->where('canceled_at', '<', new Carbon($endsAt));
    }
}
