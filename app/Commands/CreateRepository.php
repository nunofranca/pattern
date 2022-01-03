<?php

namespace App\Commands;

use App\Traits\CreateFile;
use LaravelZero\Framework\Commands\Command;

class CreateRepository extends Command
{
    use CreateFile;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:repository {name} {--interface}';

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
     *
     */
    public function handle()
    {
        $this->init('repository.stub', $this->argument('name'), $this->option('interface'));

        if ($this->inter) {
            return $this->call('create:repository-interface', [
                'name' => $this->argument('name'),
            ]);
        }
    }


}
