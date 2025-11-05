<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $databaseName = $this->argument('name') ?: config('database.connections.mysql.database');

        if (!$databaseName) {
            $this->error('Database name is required. Please provide it as an argument or set it in your .env file.');
            return;
        }

        $this->info("Creating database: {$databaseName}");

        try {
            // Create database if it doesn't exist
            DB::statement("CREATE DATABASE IF NOT EXISTS `{$databaseName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

            $this->info("Database '{$databaseName}' created successfully!");

            // Run migrations
            $this->info('Running migrations...');
            $this->call('migrate:fresh', ['--seed' => true]);

            $this->info('Database setup completed successfully!');

        } catch (\Exception $e) {
            $this->error('Failed to create database: ' . $e->getMessage());
            return 1;
        }
    }
}
