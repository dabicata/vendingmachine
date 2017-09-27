<?php

class VendingMachine
{
    private $rownumber;
    private $columnnumber;
    private $maxcells;
    private $celldepth;
    private $map;


    public function __construct($rownumber, $columnnumber, $celldepth)
    {
        $this->columnnumber = $columnnumber;
        $this->rownumber = $rownumber;
        $this->maxcells = $rownumber * $columnnumber;
        $this->celldepth = $celldepth;

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


    public function getCellDepth()
    {
        return $this->celldepth;
    }


    public function getCell($x, $y)
    {
        if (isset($this->map[$x][$y])) {

            return "error cell not mapped";
        }


        return $this->map[$x][$y];
    }

}