<?php

namespace vending;

include 'VendingMachine.php';
include 'Cell.php';
include 'Product.php';
include 'Cola.php';
include 'Snikers.php';
include 'Chips.php';

$cola = "cola";
$products1 = new cola(5, new \DateTime('18.10.17'));
$products2 = new cola(5, new \DateTime('18.10.17'));
$products3 = new cola(5, new \DateTime('18.10.17'));
$products4 = new cola(5, new \DateTime('18.10.17'));
$products5 = new cola(5, '15.10.17');
$products6 = new cola(5, '17.10.17');
$products7 = new cola(5, '15.10.17');
$products8 = new cola(5, '15.10.17');
$products9 = new cola(5, '3.10.17');
$products10 = new cola(5, '15.10.17');
$products11 = new chips(5, '15.10.17');
$products12 = new chips(5, '15.10.17');
$products13 = new chips(5, '1.10.17');
$products14 = new chips(5, '15.10.17');
$products15 = new chips(5, '15.10.17');


$b = new VendingMachine (2, 2, 12);
$b->defineMachine();
$b->loadProducts(array($products1, $products2, $products3, $products4, $products5, $products6, $products7, $products8, $products9, $products10, $products11, $products12, $products13, $products14, $products15));
$b->loadProducts($b->loadProducts());
$b->listItems();
$b->listItems();

