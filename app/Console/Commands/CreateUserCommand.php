<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name'] = $this->ask('What is your name?');
        $user['email'] = $this->ask('What is your Email?');
        $user['password'] = $this->secret('Enter Password');

        $roleName = $this->choice('What is your role?', ['admin', 'editor'], 1);
        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            $this->error('Role does not exist!');

            return -1;
        }


        User::create($user);

        $this->info('User '.$user['email'].' created successfully!');

        return 0;
    }
}
