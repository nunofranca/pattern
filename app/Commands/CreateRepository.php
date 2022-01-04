<?php

namespace App\Commands;

use App\Traits\StubFiles;
use LaravelZero\Framework\Commands\Command;

class CreateRepository extends Command
{
    use StubFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:repository {name} {--i|interface} {--a|abstract}';

    protected $description = 'Creates the child class of BaseRepository';

    protected $stub;

    protected $nameFile;

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     * @return string
     */


    public function handle()
    {

        $this->pathParent = config('pattern_paths.paths.repositories');

        $this->interface = $this->option('interface');

        $this->stub = $this->getStub();

        $this->content = $this->getContent();

        $this->path = $this->createPath();

        $this->nameFile = $this->formNameFile();

        $this->createFile();

        if ($this->interface) {
            $this->call('create:repository-interface', [
                'name' => $this->argument('name'),
                '--methods' => true,
            ]);
        }

    }

    public function getStub()
    {
        if ($this->interface) {
            return file_get_contents(__DIR__ . "/../Stubs/repositories/repository-with-interface.stub");
        }

        return file_get_contents(__DIR__ . "/../Stubs/repositories/repository-without-interface.stub");

    }

    private function createFile()
    {
        $path = $this->pathParent . $this->argument('name');

        $file = $path . "/" . $this->nameFile;

        if (!is_file($file)) {
            file_put_contents($file, $this->content);
            $this->question($this->nameFile . " Criado com sucesso");
            return $this;
        }


    }


    private function formNameFile(): string
    {
        return $this->argument('name') . 'RepositoryEloquent.php';
    }

}
