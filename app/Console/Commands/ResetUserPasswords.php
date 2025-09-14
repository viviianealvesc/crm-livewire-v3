<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetUserPasswords extends Command
{
    protected $signature = 'users:reset-passwords';
    protected $description = 'Reset all user passwords to use the current hashing algorithm';

    public function handle()
    {
        $users = User::all();
        
        if ($users->isEmpty()) {
            $this->info('No users found in the database.');
            return;
        }

        $this->info("Found {$users->count()} users. Resetting passwords...");

        foreach ($users as $user) {
            // Set a temporary password that the user can change
            $user->password = Hash::make('password123');
            $user->save();
            
            $this->line("Reset password for: {$user->email}");
        }

        $this->info('All user passwords have been reset to "password123".');
        $this->warn('Please ask users to change their passwords on first login.');
    }
}
