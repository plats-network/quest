<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;


use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

// implements WithHeadings to add headings, we can omit this if we want
class UserExport implements FromQuery, WithHeadings
{
    // add headings if we implements WithHeadings
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Email Verified At',
            'Created At',
            'Updated At',
        ];
    }

    // because we implements FromQuery we need to add this query() method
    public function query()
    {
        return User::query();   // class that we use for the query
    }
}
