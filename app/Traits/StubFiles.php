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

        if (!$this->file->isDirectory($this->pathParent)) $this->file->makeDirectory($this->pathParent);

        if (!$this->file->isDirectory($this->pathParent . '/' . $this->argument('name'))) $this->file->makeDirectory($this->pathParent . '/' . $this->argument('name'));

        return $this->pathParent . '/' . $this->argument('name');
    }

    public function getContent()
    {
        $content = str_replace('{{name}}', $this->argument('name'), $this->stub);
        return str_replace('{{nameAttribute}}', Str::lower($this->argument('name')), $content);
    }

    private function questions()
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
