<?php

include './vendor/autoload.php';
use ReadCSV\ReadFile;

$file = './assets/data-file.csv';
$csv = new ReadFile($file);
echo "<pre>";
var_dump($csv->data);
echo "<pre>";