<?php

namespace App\Traits;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;


trait StubFiles
{
    protected $pathParent;
    protected $file;
    protected $content;
    protected $path;
    protected $command;
    protected $methods;
    protected $interface;
    protected $repository;

    private function createPath()
    {
        $this->file = new Filesystem();

        $this->file->isDirectory($this->pathParent) ?: $this->file->makeDirectory($this->pathParent);


        if ($this->argument('command') =='create:base'){
            return;
        }

      $this->file->isDirectory($this->pathParent . '/' . $this->argument('name')) ?: $this->file->makeDirectory($this->pathParent . '/' . $this->argument('name'));

    }

    public function getContent()
    {
        $arguments = $this->arguments();

        if($arguments['command'] === 'create:base'){
            $arguments['name'] = null;
        }

        $content = str_replace('{{name}}', $arguments['name'] ?? config('pattern.base.name'), $this->stub);
        $content = str_replace('{{nameAbstract}}', config('pattern.base.name'), $content);

        return str_replace('{{nameAttribute}}', Str::lower($arguments['name'] ?? config('pattern.base.name')), $content);
    }

    private function askApp()
    {
       $test =  in_array(true, $this->options());
       if(! $test){
           $this->interface = $this->choice('Deseja criar o interface?', ['no', 'yes']);

           if ($this->interface === 'yes' ? $this->interface = true : $this->interface = false);

           $this->methods = $this->choice('Deseja criar methodos básicos?', ['no', 'yes']);

           if ($this->methods  === 'yes' ? $this->methods  = true : $this->methods  = false);

           if ($this->methods) {
               $this->repository = $this->choice('Deseja criar o repositório?', ['no', 'yes']);
               if ($this->repository === 'yes' ? $this->repository  = true : $this->repository  = false);
           }
       }
    }
}
