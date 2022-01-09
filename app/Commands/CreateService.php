<?php

namespace App\Commands;


use App\Traits\StubFiles;
use Illuminate\Console\Command;


class CreateService extends Command
{
    use StubFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:service {name} {--interface} {--methods} {--repository}';

    protected $description = 'Create Class of Service with its variations';

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
        $this->interface = $this->option('interface');

        $this->methods = $this->option('methods');

        $this->repository = $this->option('repository');

        $this->pathParent = config('pattern.paths.services');

        $this->stub = $this->getStub();

        $this->content = $this->getContent();

        $this->path = $this->createPath();

        $this->nameFile = $this->formNameFile();

        $this->createFile();

        if ($this->interface) {
            $this->call('create:service-interface', [
                'name' => $this->argument('name'),
                '--methods' => true,
            ]);
        }

    }

    public function getStub()
    {
        $this->askApp();

        if ($this->interface and $this->methods) {

            if ($this->repository) {
                return file_get_contents(__DIR__ . "/../Stubs/services/service-with-methods-interface-repository.stub");
            }
            return file_get_contents(__DIR__ . "/../Stubs/services/service-with-methods-interface.stub");
        }

        if ($this->interface and !$this->methods) {
            return file_get_contents(__DIR__ . "/../Stubs/services/service-with-interface.stub");
        }

        if (!$this->interface and $this->methods) {

            if ($this->repository) {
                return file_get_contents(__DIR__ . "/../Stubs/services/service-with-methods-repository.stub");
            }
            return file_get_contents(__DIR__ . "/../Stubs/services/service-with-methods.stub");
        }

        return file_get_contents(__DIR__ . "/../Stubs/services/service.stub");
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
        return $this->argument('name') . 'Service.php';
    }

}
