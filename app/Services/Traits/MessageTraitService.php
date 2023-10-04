<?php

namespace App\Services\Traits;

use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

trait MessageTraitService
{
    /**
     * Response the request with message.
     *
     * @param  string  $value
     *
     * @return bool
     */
    public function withMessage($value)
    {
        return $this->with('message', $value);
    }

    /**
     * Response the request with success.
     *
     * @param  string  $value
     *
     * @return bool
     */
    public function withSuccess($value)
    {
        return $this->with('success', $value);
    }

    /**
     * Flash a piece of data to the session.
     *
     * @param  string|array  $key
     * @param  mixed  $value
     *
     * @return boolean
     */
    public function with($key, $value = null)
    {
        $key = is_array($key) ? $key : [$key => $value];

        foreach ($key as $k => $v) {
            session()->flash($k, $v);
        }

        return true;
    }

    /**
     * Flash a container of errors to the session.
     *
     * @param  \Illuminate\Contracts\Support\MessageProvider|array|string  $provider
     * @param  string  $key
     *
     * @return boolean
     *
     */
    public function withErrors($provider, $key = 'default')
    {
        $value = $this->parseErrors($provider);

        $errors = session()->get('errors', new ViewErrorBag());

        if (!$errors instanceof ViewErrorBag) {
            $errors = new ViewErrorBag();
        }

        session()->flash(
            'errors',
            $errors->put($key, $value)
        );

        return false;
    }

    /**
     * Parse the given errors into an appropriate value.
     *
     * @param  \Illuminate\Contracts\Support\MessageProvider|array|string  $provider
     *
     * @return \Illuminate\Contracts\Support\MessageBag
     */
    protected function parseErrors($provider)
    {
        if ($provider instanceof MessageProvider) {
            return $provider->getMessageBag();
        }

        return new MessageBag((array) $provider);
    }
}
