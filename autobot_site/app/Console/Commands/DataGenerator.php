<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DataGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generateUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Генерация данных';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info(sprintf("Создано %s пользователей", User::factory()->count(1)->create()->count()));
        return 0;
    }
}
