<?php

namespace ReadCSV;

use Exception;

class ReadFile {
    /**
     * @var resource|false
     */
    public $file;
    /**
     * @var array|false
     */
    public $data;

    public function __construct($file){
        if(file_exists($file)){
            $this->file = fopen($file, "r");
            $this->data = $this->readFile($this->file);
        }else{
            throw new Exception("file not exist");
        }
    }
    /**
     * Lectura del archivo csv y obtenmos una array
     *
     * @param  resource $file
     * @return array
     */
    public function readFile($file):array{
        $data = array();
        while(($row = fgetcsv($file, 0, ";")) !== false){
            $newRow = array();
            foreach($row as $colum){
                if($colum != ""){
                    $newRow[] = $colum;
                }
            }
            $data[] = $newRow;
        }
        return $data;
    }
    public function findValue($value) {
        $data = array_filter($this->data, function($row) use ($value){
            foreach($row as $columValue){
                if($columValue == $value){
                    return $row;
                }
            }
        });
        return $data;
    }
}