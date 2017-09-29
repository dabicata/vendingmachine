<?php

namespace vending;

/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 9/108/17
 * Time: 5:36 PM
 */
include 'VendingMachine.php';
include 'Cell.php';
include 'Product.php';


$a = new Cell(10);
$a1 = new Cell(10);
$a2 = new Cell(10);
$a3 = new Cell(10);
$a4 = new Cell(10);
$a5 = new Cell(10);
$a6 = new Cell(10);
$a7 = new Cell(10);
$a8 = new Cell(10);
$a9 = new Cell(10);
$a10 = new Cell(10);
$a11 = new Cell(10);
$products1 = new Product('pizza1', '10', '2', 2018);
$products2 = new Product('pizza2', '10', '3', 2018);
$products3 = new Product('pizza3', '15', '1', 2018);
$products4 = new Product('pizza4', '25', '1', 2018);
$products5 = new Product('pizza5', '40', '4', 2018);
$products6 = new Product('pizza6', '10', '131', 2018);
$products7 = new Product('pizza7', '10', '1', 2018);
$products8 = new Product('pizza8', '10', '1', 2018);
$products9 = new Product('pizza9', '10', '1', 2018);
$products10 = new Product('pizza10', '10', '1', 2018);
$products11 = new Product('pizza11', '10', '1', 2018);
$products12 = new Product('pizza12', '3', '1', 2018);
$b = new VendingMachine (4, 3, 15);
$b->createCell(array($a, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11));
$b->loadProduct(array($products1, $products2, $products3, $products4, $products5, $products6, $products7, $products8, $products9, $products10, $products11, $products12));
//$b->getProduct(2, 2);
$b->combineCells(1, 1, 1, 3);
$b->listItems();