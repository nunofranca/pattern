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

    private function questionInterface()
    {
       $test =  in_array(true, $this->options());
       if(! $test){
           $this->interface = $this->ask('Deseja criar o interface?', 'yes');

           $this->methods = $this->ask('Deseja criar methodos básicos?', 'yes');

           if ($this->methods === "yes") {
               $this->repository = $this->ask('Deseja criar o repositório?', 'yes');
           }
       }




    }
}
