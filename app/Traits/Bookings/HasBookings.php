<?php

declare(strict_types=1);

namespace App\Traits\Bookings;

use App\Models\Bookings\BookableBooking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasBookings
{
    use BookingScopes;

    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @param  string  $related
     * @param  string  $name
     * @param  string  $type
     * @param  string  $id
     * @param  string  $localKey
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    abstract public function morphMany($related, $name, $type = null, $id = null, $localKey = null);

    /**
     * Get the booking model name.
     */
    abstract public static function getBookingModel(): string;

    /**
     * Boot the HasBookings trait for the model.
     *
     * @return void
     */
    public static function bootHasBookings()
    {
        static::deleted(function (self $model) {
            $model->bookings()->delete();
        });
    }

    /**
     * The customer may have many bookings.
     */
    public function bookings(): MorphMany
    {
        return $this->morphMany(static::getBookingModel(), 'customer', 'customer_type', 'customer_id');
    }

    /**
     * Get bookings of the given resource.
     */
    public function bookingsOf(Model $bookable): MorphMany
    {
        return $this->bookings()->where('bookable_type', $bookable->getMorphClass())->where('bookable_id', $bookable->getKey());
    }

    /**
     * Check if the person booked the given model.
     */
    public function isBooked(Model $bookable): bool
    {
        return $this->bookings()->where('bookable_id', $bookable->getKey())->exists();
    }

    /**
     * Book the given model at the given dates with the given price.
     */
    public function newBooking(Model $bookable, string $startsAt, string $endsAt, float $price = 1000): BookableBooking
    {
        //dd($this->bookings());
        return $this->bookings()->create([
            'bookable_id' => $bookable->getKey(),
            'bookable_type' => $bookable->getMorphClass(),
            'customer_id' => $this->getKey(),
            'customer_type' => $this->getMorphClass(),
            'price' => $price,
            'quantity' => 1,
            'total_paid' => 1,
            'currency' => 'vnd',
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
        ]);
    }
}
