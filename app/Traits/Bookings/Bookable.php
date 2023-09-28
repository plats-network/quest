<?php

declare(strict_types=1);

namespace App\Traits\Bookings;

use App\Models\Bookings\BookableBooking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Bookable
{
    use BookingScopes;

    /**
     * Register a saved model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    abstract public static function saved($callback);

    /**
     * Register a deleted model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    abstract public static function deleted($callback);

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
     * Get the rate model name.
     */
    abstract public static function getRateModel(): string;

    /**
     * Get the availability model name.
     */
    abstract public static function getAvailabilityModel(): string;

    /**
     * Boot the Bookable trait for the model.
     *
     * @return void
     */
    public static function bootBookable()
    {
        static::deleted(function (self $model) {
            $model->bookings()->delete();
        });
    }

    /**
     * Attach the given bookings to the model.
     *
     * @param  \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|array  $ids
     * @param  mixed  $bookings
     */
    public function setBookingsAttribute($bookings): void
    {
        static::saved(function (self $model) use ($bookings) {
            $this->bookings()->sync($bookings);
        });
    }

    /**
     * Attach the given rates to the model.
     *
     * @param  \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|array  $ids
     * @param  mixed  $rates
     */
    public function setRatesAttribute($rates): void
    {
        static::saved(function (self $model) use ($rates) {
            $this->rates()->sync($rates);
        });
    }

    /**
     * Attach the given availabilities to the model.
     *
     * @param  \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|array  $ids
     * @param  mixed  $availabilities
     */
    public function setAvailabilitiesAttribute($availabilities): void
    {
        static::saved(function (self $model) use ($availabilities) {
            $this->availabilities()->sync($availabilities);
        });
    }

    /**
     * The resource may have many bookings.
     */
    public function bookings(): MorphMany
    {
        return $this->morphMany(static::getBookingModel(), 'bookable', 'bookable_type', 'bookable_id');
    }

    /**
     * Get bookings by the given customer.
     */
    public function bookingsBy(Model $customer): MorphMany
    {
        return $this->bookings()->where('customer_type', $customer->getMorphClass())->where('customer_id', $customer->getKey());
    }

    /**
     * The resource may have many availabilities.
     */
    public function availabilities(): MorphMany
    {
        return $this->morphMany(static::getAvailabilityModel(), 'bookable', 'bookable_type', 'bookable_id');
    }

    /**
     * The resource may have many rates.
     */
    public function rates(): MorphMany
    {
        return $this->morphMany(static::getRateModel(), 'bookable', 'bookable_type', 'bookable_id');
    }

    /**
     * Book the model for the given customer at the given dates with the given price.
     */
    public function newBooking(Model $customer, string $startsAt, string $endsAt, float $price = 1000, int $quantity = 1): BookableBooking
    {
        return $this->bookings()->create([
            'bookable_id' => static::getKey(),
            'bookable_type' => static::getMorphClass(),
            'customer_id' => $customer->getKey(),
            'customer_type' => $customer->getMorphClass(),
            'price' => $price,
            'quantity' => 1,
            'total_paid' => 1,
            'currency' => 'vnd',
            'starts_at' => (new Carbon($startsAt))->toDateTimeString(),
            'ends_at' => (new Carbon($endsAt))->toDateTimeString(),
        ]);
    }
}
