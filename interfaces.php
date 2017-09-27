<?php

interface ItemsGetterInterface
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


}
