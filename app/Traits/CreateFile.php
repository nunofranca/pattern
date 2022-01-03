<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait CreateFile
{
    public $typeClass;

    public $argument;

    public $stub;

    public $content;

    public $pathType;

    public $contentAttribute;

    public $optionInterface;

    public function init($stub, $argument = null, $optionInterface = false)
    {

        $this->stub = $stub;
        $this->argument = $argument;
        $this->optionInterface = $optionInterface;


        $template = file_get_contents(__DIR__ . "/../Stubs/" . $this->stub);


        $this->typeClass = Str::ucfirst(explode('.', explode('-', $this->stub)[0])[0]);


        $this->modifyContent($template);
    }

    private function modifyContent($template)
    {
        $content = str_replace('{{name}}', $this->argument, $template);
        $content = str_replace('{{nameAttribute}}', Str::lower($this->argument), $content);


        if (!$this->optionInterface) {
            $content = str_replace(' implements ' . $this->argument . $this->typeClass . 'Interface', '', $content);

        }
        $this->content = $content;

        $this->createPath();
    }


//    private function createPath()
//    {
//
//        switch ($this->typeClass) {
//            case 'Service':
//                $this->pathType = __DIR__ . "/../" . $this->typeClass . "s";
//                break;
//            case "Repository":
//                $this->pathType = __DIR__ . "/../" . str_replace('y', 'ies', $this->typeClass);
//                break;
//            case "Base":
//                $this->pathType = __DIR__ . "/../Repositories";
//                break;
//        }
//
//
//        if (!File::isDirectory($this->pathType)) File::makeDirectory($this->pathType);
//        if (!File::isDirectory("$this->pathType/$this->argument")) File::makeDirectory("$this->pathType/$this->argument");
//
//        $this->createFile();
//
//    }

    private function createFile()
    {

        $nameFile = $this->formNameFile();

        $nameFilePath = "/$this->pathType/$this->argument/$nameFile.php";

        if (!is_file($nameFilePath)) {
            if (file_put_contents($nameFilePath, $this->content))
                $this->info($this->argument . $nameFile . ' successfully created');
        }
    }

    private function formNameFile(): string
    {
        $nameFile = explode('.', $this->stub);

        $nameFile = explode('-', $nameFile[0]);

        if (array_key_exists(1, $nameFile)) {
            return Str::ucfirst($this->argument . Str::ucfirst($nameFile[0]) . Str::ucfirst($nameFile[1]));
        }
        if ($nameFile[0] === 'repository') {
            return Str::ucfirst($this->argument . Str::ucfirst($nameFile[0])) . 'Eloquent';
        }

        return Str::ucfirst($nameFile[0]);

    }

}
