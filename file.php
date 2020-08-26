<?php

namespace App;

class File {
    private $path;
    public $lines = [];

    function __construct($path)
    {
        $this->path = $path;
    }

    function read()
    {
        $f = fopen($this->path, 'r');

        while ($data = fgets($f)) {
            array_push($this->lines, $data);
        }

        fclose($f);
    }
}