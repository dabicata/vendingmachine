<?php

interface GetItemsInterface
{
    public function getItems();
}

interface DefineMachineInterface
{
    public function getRow();

    public function getColumn();

    public function getCells();

    public function getCellDepth();


}

interface ItemMapInterface
{
    public function itemMap($rownumber, $columnnumber, $item);


}

class GetItems implements GetItemsInterface
{
    private $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function getItems()
    {
        return $this->items;
    }
}

class DefineMachine implements DefineMachineInterface
{
    private $rownumber;
    private $columnnumber;
    private $maxcells;
    private $celldepth;

    public function __construct($rownumber, $columnnumber, $celldepth)
    {
        $this->columnnumber = $columnnumber;
        $this->rownumber = $rownumber;
        $this->maxcells = $rownumber * $columnnumber;
        $this->celldepth = $celldepth;

    }

    public function getRow()
    {
        return $this->rownumber;
    }

    public function getColumn()
    {
        return $this->columnnumber;
    }

    public function getCells()
    {
        return $this->maxcells;
    }

    public function getCellDepth()
    {
        return $this->celldepth;
    }
}

class ItemMapping implements ItemMapInterface
{
    public function itemMap($rownumber, $columnnumber, $item)
    {

    }
}


function start()
{

}