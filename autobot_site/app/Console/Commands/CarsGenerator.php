<?php

namespace App\Console\Commands;

use App\Models\RegCars;
use Illuminate\Console\Command;

class CarsGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generateRegCars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создание данных';
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info(sprintf("Создано %s машин", RegCars::factory()->count(1)->create()->count()));
        return 0;
    }
}
