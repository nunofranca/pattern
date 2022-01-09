<?php

namespace App\Commands;

use App\Traits\StubFiles;
use LaravelZero\Framework\Commands\Command;

class CreatePattern extends Command
{
    use StubFiles;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:pattern {name}';

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


        $this->call('create:service', [
            'name' => $this->argument('name'),
            '--methods' => true,
            '--interface' => true,
            '--repository' => true
        ]);

        $this->call('create:service-interface', [
            'name' => $this->argument('name'),
            '--methods' => true,
        ]);

        $this->call('create:repository', [
            'name' => $this->argument('name'),
            '--interface' => true
        ]);

        $this->call('create:repository-interface', [
            'name' => $this->argument('name'),
            '--methods' => true,
        ]);
        $this->call('create:base');
    }

}
