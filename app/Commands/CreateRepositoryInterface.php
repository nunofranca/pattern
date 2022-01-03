<?php

namespace App\Commands;

use App\Traits\CreateFile;
use LaravelZero\Framework\Commands\Command;

class CreateRepositoryInterface extends Command
{

    use CreateFile;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:repository-interface {name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->init('repository-interface.stub',  $this->argument('name'));
    }

}
