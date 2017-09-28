<?php

class VendingMachine
{
    private $rownumber;
    private $columnnumber;
//    private $maxcells;
    private $cellsize;
    private $map;


    public function __construct($rownumber, $columnnumber, $cellsize)
    {
        $this->columnnumber = $columnnumber;
        $this->rownumber = $rownumber;
//        $this->maxcells = $rownumber * $columnnumber;
        $this->cellsize = $cellsize;

    }

    public function createCell($obj)
    {

        $this->map = [];
        $counter = 0;
        for ($y = 0; $y < $this->rownumber; $y++) {
            for ($x = 0; $x < $this->columnnumber; $x++) {
                if (isset($obj[$counter])) {
                    $this->map[$y][] = $obj[$counter++];
                } else {
                    break;
                }

            }
        }


        var_dump($this->map);
    }

    public function getRow()
    {
        return $this->rownumber;
    }

    public function getColumn()
    {
        return $this->columnnumber;
    }


    public function getCellsize()
    {
        return $this->cellsize;
    }


    public function getCell($x, $y)
    {
        if (isset($this->map[$x][$y])) {

            return "error cell not mapped";
        }


        return $this->map[$x][$y];
    }

    public function combineCells($x, $y, $a, $b)
    {
        if ($x == $a && $b == $y + 1) {
            $this->map[$x][$y]->setSize($this->map[$x][$y]->getSize() * 2);
            $this->map[$x][$y]->setCombined(true);
            $this->map[$a][$b]->setCombined(true);
            $this->map[$a][$b]->setSize(0);
        } else {
            echo 'error you can combine only cells on same row from left to right';
        }


    }

    public function loadProduct($obj2)
    {


        $counter2 = 0;
        for ($y = 0; $y < $this->rownumber; $y++) {
            for ($x = 0; $x < $this->columnnumber; $x++) {
                if (isset($obj2[$counter2]) && $this->map[$y][$x]->getSize() >= $obj2[$counter2]->getSize()) {
                    $this->map[$y][$x]->setText($obj2[$counter2]);
                    /* $hey = (($this->map[$y][$x]->getSize() / ($obj2[$counter2]->getSize())));
                                         $this->map[$y][$x]->getProduct()->setQuantity((int)($this->map[$y][$x]->getSize() / ($obj2[$counter2]->getSize())));
                                        ($obj2[$counter2]->getQuantity() - (($obj2[$counter2]->getQuantity() / $this->map[$y][$x]->getSize()))) > $obj2[$counter2]->getQuantity())*/
                    if (($obj2[$counter2]->getQuantity() * $obj2[$counter2]->getSize()) > $this->map[$y][$x]->getSize()) {
                        $quantity = $obj2[$counter2]->getQuantity();
                        $this->map[$y][$x]->getProduct()->setQuantity((int)($this->map[$y][$x]->getSize() / ($obj2[$counter2]->getSize())));
                        echo ($quantity - $this->map[$y][$x]->getProduct()->getQuantity()) . " " . $this->map[$y][$x]->getProduct()->getProductName() . "s " . "not loaded. \n";
                    }
                    /*                    var_dump($this->map[$y][$x]->getProduct());*/

                    $counter2++;
                } else {
                    $counter2++;
                    echo "Product can't be loaded. \n";
                }
            }
        }


    }
}
