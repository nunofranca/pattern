<?php

namespace App\Commands;

use App\Traits\CreateFile;
use App\Traits\StubFiles;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;


class CreateServiceInterface extends Command
{
    use StubFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:service-interface {name} {--interface} {--methods} {--repository}';

    protected $stub;

    protected $file;

    protected $nameFile;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new contract interface';


    public function handle()
    {

        $this->pathParent = config('pattern_paths.paths.services');

        $this->stub = $this->getStub();

        $this->content = $this->getContent();

        $this->path = $this->createPath();

        $this->nameFile = $this->formNameFile();

        $this->createFile();

    }

    public function getStub()
    {

        if ($this->methods == "yes") {
            return file_get_contents(__DIR__ . "/../Stubs/services/interfaces/service-interface-with-methods.stub");
        }

        return file_get_contents(__DIR__ . "/../Stubs/services/interfaces/service-interface.stub");


    }

    private function createFile()
    {

        $path = $this->pathParent . $this->argument('name');

        $file = $path . "/" . $this->nameFile;


        if (!is_file($file)) {
            file_put_contents($file, $this->content);
            $this->question(str_replace('.php', '', $this->nameFile) . " Criado com sucesso");
            return $this;
        }
        $this->error(str_replace('.php', '', $this->nameFile) . " Já existe");

    }

    private function formNameFile(): string
    {
        return $this->argument('name') . 'ServiceInterface.php';
    }

}
