<?php

//https://www.sitepoint.com/write-javascript-style-test-watchers-php/

require_once __DIR__ . "/../vendor/autoload.php";

function getFileIteratorFromPath($path) {
    return new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path),
        RecursiveIteratorIterator::SELF_FIRST
    );
}

function deleteFilesBeforeTests($path) {
    foreach (getFileIteratorFromPath($path) as $file) {
        if ($file->getExtension() === "php") {
            unlink($file->getPathname());
        }
    }
}

function compileFilesBeforeTests($path) {
    foreach (getFileIteratorFromPath($path) as $file) {
        if ($file->getExtension() === "pre") {
            $pre = $file->getPathname();
            $php = preg_replace("/pre$/", "php", $pre);

            //Pre\Plugin\compile($pre, $php, true, true);

            print ".";
        }
    }
}

print "Building files" . PHP_EOL;

deleteFilesBeforeTests(__DIR__ . "/../src");
compileFilesBeforeTests(__DIR__ . "/../src");

print PHP_EOL;