<?php

namespace App\Commands;


use App\Traits\StubFiles;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;


class CreateService extends Command
{
    use StubFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:service {name} {--interface} {--methods} {--repository}';

    protected $description = 'Create a new contract interface';

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


        $this->pathParent = config('pattern_paths.paths.services');

        $this->stub = $this->getStub();

        $this->content = $this->getContent();

        $this->path = $this->createPath();

        $this->nameFile = $this->formNameFile();

        $this->createFile();

        if ($this->interface === "yes") {
            $this->call('create:service-interface', [
                'name' => $this->argument('name'),
                '--methods' => true,
            ]);
        }

    }

    public function getStub()
    {
        $this->questionInterface();

        if ($this->interface === "yes" and $this->methods === "yes") {
            if ($this->repository === "yes") {
                return file_get_contents(__DIR__ . "/../Stubs/services/service-with-methods-interface-repository.stub");
            }
            return file_get_contents(__DIR__ . "/../Stubs/services/service-with-methods-interface.stub");
        }

        if ($this->interface === "yes" and !$this->methods != "yes") {
            return file_get_contents(__DIR__ . "/../Stubs/services/service-with-interface.stub");
        }

        if (!$this->interface != "yes" and $this->methods === "yes") {
            if ($this->repository === "yes") {
                return file_get_contents(__DIR__ . "/../Stubs/services/service-with-methods-repository.stub");
            }
            return file_get_contents(__DIR__ . "/../Stubs/services/service-with-methods.stub");
        }

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

        $this->error($this->nameFile . " Já existe");

    }


    private function formNameFile(): string
    {
        return $this->argument('name') . 'Service.php';
    }

}
