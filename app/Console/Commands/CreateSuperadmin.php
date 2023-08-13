<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperadmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-superadmin {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create superadmin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if(User::where('email', $this->argument('email'))->exists()) {
            $this->error('The email has already been taken.');
            return;
        }
        $user = User::create([
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password'))
        ]);

        $user->assign('superadmin');

        $this->info('The user has been created successfully.');
    }
}
