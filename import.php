<?php

namespace App;

class Import {
    private $connection;
    private $file;
    private $output;

    function __construct($connection, $output, $path)
    {
        $this->connection = $connection;
        $this->output = $output;
        $this->file = new File($path);

        $this->process();
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

            $this->output->send($index + $baseIndexSize, count($lines));
        }
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