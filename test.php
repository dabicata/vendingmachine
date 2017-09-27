<?php

class Mapper
{
    private $map;

    public function __construct($obj)
    {

        $rowsCount = 4;
        $colsCount = 3;
        $this->map = [];
        $counter = 0;
        for ($y = 0; $y < $rowsCount; $y++) {
            for ($x = 0; $x < $colsCount; $x++) {
                if (isset($obj[$counter])) {
                    $this->map[$y][] = $obj[$counter++];
                } else {
                    break;
                }

            }
        }


        var_dump($this->map);
    }

}

class Cell
{
    public $text;

    public function __construct($msg)
    {
        $this->text = $msg;

    }

}

$a = new Cell('hello');
$a1 = new Cell('hello from a1');
$a2 = new Cell('hello from a2');
$a3 = new Cell('hello from a3');
$a4 = new Cell('hello from a4');
$a5 = new Cell('hello from a5');
$a6 = new Cell('hello from a6');
$a7 = new Cell('hello from a7');
$a8 = new Cell('hello from a8');
$a9 = new Cell('hello from a9');
$a10 = new Cell('hello from a10');
$a11 = new Cell('hello from a11');
$a12 = new Cell('hello from a12');
$a13 = new Cell('hello from a13');
$a14 = new Cell('hello from a14');


$b = new Mapper (array($a, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14));

