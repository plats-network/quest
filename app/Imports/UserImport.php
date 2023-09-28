<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

// If your file includes a heading row (a row in which each cell
// indicates the purpose of that column) and you want to use
// those names as the array keys of each row, you can implements the
// WithHeadingRow.
class UserImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            // because we would have 'Name', 'Email', and 'Password' heading in our excel
            'name'     => $row['name'],
            'email'    => $row['email'],
            'password' => bcrypt($row['password']),
        ]);
    }
}
