<?php

namespace App;

class Redirect implements Output {
    function send($done, $total) {
        if ($done/$total == 1) {
            header('Location: web/success.php');
        }
    }
}