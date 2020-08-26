<?php

namespace App;

class Terminal {
    private $connection;
    private $file;

    function __construct($connection, $argv)
    {
        if (isset($argv[1])) {
            $this->connection = $connection;
            $this->file = new File($argv[1]);

            $this->process();
        } else {
            echo 'path to a csv file is not provided';
        }
    }

    function process()
    {
        $headSize = 1;
        $baseIndexSize = 1;

        $this->file->read();
        $lines = array_slice($this->file->lines, $headSize);

        foreach ($lines as $index => $line) {
            $lineFields = explode(";", $line);

            $this->saveLine([
                "active" => $lineFields[0] == 'Y' ? 1 : 0,
                "name" => $lineFields[1],
                "last_name" => $lineFields[2],
                "email" => $lineFields[3],
                "xml_id" => $lineFields[4],
                "personal_gender" => $lineFields[5],
                "personal_birthday" => date('Y-m-d', strtotime($lineFields[6])),
                "work_position" => $lineFields[7],
                "region" => $lineFields[8],
                "city" => $lineFields[9]
            ]);

            $this->progress($index + $baseIndexSize, count($lines));
        }
    }

    function progress($done, $total) {
        $perc = floor(($done / $total) * 100);
        $left = 100 - $perc;
        $write = sprintf("\033[0G\033[2K[%'={$perc}s>%-{$left}s] - $perc%% - $done/$total", "", "");
        fwrite(STDERR, $write);
    }

    function saveLine($fields)
    {
        $this->connection->prepare(
            "INSERT INTO users (
                active,
                name,
                last_name,
                email,
                xml_id,
                personal_gender,
                personal_birthday,
                work_position,
                region,
                city
            ) VALUES (
                :active,
                :name,
                :last_name,
                :email,
                :xml_id,
                :personal_gender,
                :personal_birthday,
                :work_position,
                :region,
                :city
            )"
        )->execute($fields);
    }
}