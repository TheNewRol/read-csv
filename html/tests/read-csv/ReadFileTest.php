<?php declare(strict_types=1);

namespace ReadCSV\Test;

use ReadCSV\ReadFile;
use PHPUnit\Framework\TestCase;

final class ReadFileTest extends TestCase {
    private $patchFile;
    /**
     * @var ReadFile
     */
    public $obj;

    protected function setUp():void{
        $this->patchFile = './assets/data-file.csv';
        if(file_exists($this->patchFile)){
            $this->obj = new ReadFile($this->patchFile);
        }else{
            $this->printError("No such file or directory");
        }
    }

    public function testConstruct() {
        $this->assertIsResource($this->obj->file, "El archivo no se abre");
        $this->assertFalse(!$this->obj->file, "No se puede leer el archivo");
        $this->assertIsArray($this->obj->data, "No se ha optenido un array");
    }
    public function testReadFile(){
        $dataFile = $this->obj->readFile($this->obj->file);
        $this->assertIsArray($dataFile, "No devulve un array");
    }
    public function testFindValue(){
        $data = $this->obj->findValue('02912746A');
        $this->assertIsArray($data, "Valor no encontrado");
    }
    private function printError($message){
        //https://joshtronic.com/2013/09/02/how-to-use-colors-in-command-line-output/
        echo "\e[0;31;42mError\e[0m\n";
        echo "\e[0;31;42m" . $message ."\e[0m\n";
        die;
    }
}