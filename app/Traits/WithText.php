<?php

namespace App\Traits;

trait WithText
{
    /**
     * Use this function instead of getAreaNameAttribute
     */
    public function getNameTextAttribute()
    {
        return '';
    }
}
