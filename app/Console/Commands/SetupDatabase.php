<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class SetupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:setup {--database=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Complete database setup with migrations and seeding';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $databaseName = $this->option('database') ?: config('database.connections.' . config('database.default') . '.database');

        if (!$databaseName) {
            $this->error('Database name is required. Please provide it with --database option or set it in your .env file.');
            return;
        }

        $connection = config('database.default');
        $this->info("Setting up database: {$databaseName} (Connection: {$connection})");

        try {
            if ($connection === 'sqlite') {
                // For SQLite, just ensure the database file exists
                $this->info('Using SQLite database...');
                $databasePath = database_path('database.sqlite');

                if (!file_exists($databasePath)) {
                    touch($databasePath);
                    $this->info("✓ SQLite database file created at: {$databasePath}");
                } else {
                    $this->info("✓ SQLite database file already exists at: {$databasePath}");
                }
            } else {
                // For MySQL/MariaDB, create database
                $this->info('Creating database...');
                DB::statement("CREATE DATABASE IF NOT EXISTS `{$databaseName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                $this->info("✓ Database '{$databaseName}' created successfully!");
            }

            // Run migrations fresh
            $this->info('Running migrations...');
            Artisan::call('migrate:fresh', [], $this->getOutput());
            $this->info('✓ Migrations completed!');

            // Run seeders
            $this->info('Seeding database...');
            Artisan::call('db:seed', [], $this->getOutput());
            $this->info('✓ Database seeded successfully!');

            // Create storage link
            $this->info('Creating storage link...');
            Artisan::call('storage:link', [], $this->getOutput());
            $this->info('✓ Storage link created!');

            $this->info('');
            $this->info('🎉 Database setup completed successfully!');
            $this->info('You can now run: php artisan serve');

        } catch (\Exception $e) {
            $this->error('Failed to setup database: ' . $e->getMessage());
            return 1;
        }
    }
}
