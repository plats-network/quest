<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use function Termwind\{ask};
use function Termwind\{render};

/*
 * Command: command: php artisan users:search
 * */

final class UsersSearch extends Command
{
    protected $signature = 'users:search';

    protected $description = 'Search for users in the system';

    public function handle(): int
    {
        $searchTerm = ask(<<<'HTML'
            <span class="mt-1 ml-2 mr-1 bg-green px-1 text-black">
                Search term:
            </span>
        HTML);

        //$users = $this->searchUsers($searchTerm);
        //Name not contain 'random' text
        $users = User::query()
            ->where('name', 'like', "%{$searchTerm}%")
            //->orWhere('email', 'like', "%{$searchTerm}%")
            ->where('email', 'not like', '%random%')
            ->limit(10)
            ->get();

        render(view('cli.user-search', [
            'users' => $users,
        ]));

        return self::SUCCESS;
    }

    public function handle2(): int
    {
        $searchTerm = $this->ask('Search term: ');

        $users = $this->searchUsers($searchTerm);

        $rows = $users->map(fn (User $user): array => [
            $user->name,
            $user->email,
            $user->email_verified_at ?? 'No!',
        ])->all();

        $this->info('Found '.count($users).' users');
        $this->table(['Name', 'Email', 'Approved'], $rows);

        return self::SUCCESS;
    }
}
