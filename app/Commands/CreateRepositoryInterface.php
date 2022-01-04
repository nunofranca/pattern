<?php

namespace App\Commands;


use App\Traits\StubFiles;
use LaravelZero\Framework\Commands\Command;

class CreateRepositoryInterface extends Command
{

    use StubFiles;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:repository-interface {name} {--methods}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Creates the interface of the BaseRepository child class';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->methods = $this->option('methods');


        $this->pathParent = config('pattern_paths.paths.repositories');

        $this->stub = $this->getStub();

        $this->content = $this->getContent();

        $this->path = $this->createPath();

        $this->nameFile = $this->formNameFile();

        $this->createFile();

    }


    public function getStub()
    {

        if ($this->methods) {
            return file_get_contents(__DIR__ . "/../Stubs/repositories/interfaces/repository-interface-with-methods.stub");
        }

        return file_get_contents(__DIR__ . "/../Stubs/repositories/interfaces/repository-interface.stub");

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

    }

    private function formNameFile(): string
    {
        return $this->argument('name') . 'RepositoryInterface.php';
    }

}
