<?php

namespace App\Commands;


use App\Traits\StubFiles;
use LaravelZero\Framework\Commands\Command;

class CreateBase extends Command
{
    use StubFiles;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:base {name}';

    protected $description = 'Create the abstract class with eloquent default methods';

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

        $this->stub = $this->getStub();

        $this->content = $this->getContent();

        $this->nameFile = $this->formNameFile();

        $this->createFile();

    }

    public function getStub()
    {
        return file_get_contents(__DIR__ . "/../Stubs/repositories/base.stub");
    }

    private function createFile()
    {

        $file =  $this->pathParent . "/" . $this->nameFile;

        if (!is_file($file)) {
            file_put_contents($file, $this->content);
            $this->question(str_replace('.php','',$this->nameFile) . " Criado com sucesso");
            return $this;
        }

    }


    private function formNameFile(): string
    {
        return $this->argument('name') . 'Repository.php';
    }

}
