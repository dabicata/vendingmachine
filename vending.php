<?php

/*interface ItemsGetterInterface
{
    public function getItems();
}

interface VendingMachineInterface
{
    public function getRow();

    public function getColumn();

    public function getCells();

    public function getCellDepth();


}

interface ItemLoaderInterface
{
    public function loadItem($object, $item);


}

interface ItemGetterInterface
{
    public function getItem($object, $item);


}*/


class VendingMachine implements VendingMachineInterface
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

    public
    function getRow()
    {
        return $this->rownumber;
    }

    public
    function getColumn()
    {
        return $this->columnnumber;
    }

    public
    function getCells()
    {
        return $this->maxcells;
    }

    public
    function getCellDepth()
    {
        return $this->celldepth;
    }
}

class Cell
{
    private $itemname;
    private $quantity;
    private $size;

    public function __construct($itemname, $quantity, $size)
    {
        $this->itemname = $itemname;
        $this->quantity = $quantity;
        $this->size = $size;

    }

    public function getItemName()
    {
        return $this->itemname;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}

class ItemGetter implements ItemGetterInterface
{
    private $item;

    public function __construct($object, $item)
    {
        $this->item = $item;
    }

    public function getItem($object, $item)
    {
        // TODO: Implement getItem() method.
    }
}

class ItemLoader implements ItemLoaderInterface
{
    public function loadItem($object, $item)
    {

    }
}

class Mapper
{
    private $map;

    public function __construct($obj)
    {
        $this->map = $obj;
        var_dump($this->map);
    }


}