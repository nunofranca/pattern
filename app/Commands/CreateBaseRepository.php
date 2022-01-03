<?php

namespace App\Commands;

use App\Traits\CreateFile;
use Illuminate\Console\Command;


class CreateBaseRepository extends Command
{
    use CreateFile;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:base-repository';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new contract interface';

    /**
     * The type of class being generated.
     *
     * @var string

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     * @return string
     */

    public function handle()
    {

        $this->init('base-repository.stub');


    }

}
