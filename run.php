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


$products1 = new Product('pizza1', '25', "04.10.17");
$products2 = new Product('pizza1', '25', "08.10.17");
$products11 = new Product('pizza1', '25', "09.10.17");
$products12 = new Product('pizza1', '25', "10.10.17");
$products4 = new Product('pizza2', '40', "11.10.17");
$products5 = new Product('pizza2', '40', "12.10.17");
$products6 = new Product('pizza2', '40', "13.10.17");
$products7 = new Product('pizza7', '50', "14.10.17");
$products8 = new Product('pizza8', '505', "15.10.17");
$products9 = new Product('pizza9', '20', "06.10.17");
$products = array($products1, $products2, $products11, $products12);
$products2 = array($products4, $products5, $products6);
$products3 = array($products7, $products8, $products9);
$b = new VendingMachine (2, 4, 120);
$b->defineMachine();
$b->loadProduct(array($products, $products2, $products3));
$b->listItems();
