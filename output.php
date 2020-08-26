<?php

namespace App;

interface Output {
    public function send($done, $total);
}