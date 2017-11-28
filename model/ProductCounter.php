<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 11/13/17
 * Time: 11:03 AM
 */

namespace vending;

include_once __DIR__ . '/Chips.php';
include_once __DIR__ . '/Cola.php';
include_once __DIR__ . '/Snikers.php';


class ProductCounter
{
    public function getCount($array)
    {
        $colaCount = 0;
        $chipsCount = 0;
        $snikersCount = 0;
        foreach ($array as $product) {

            if ($product->getProductName() == 'Cola') {
                $colaCount++;
            } elseif ($product->getProductName() == 'Chips') {
                $chipsCount++;
            } elseif ($product->getProductName() == 'Snikers') {
                $snikersCount++;
            }
        }
        $productsCounter = ["Cola" => $colaCount, "Chips" => $chipsCount, "Snikers" => $snikersCount];

        return $productsCounter;
    }
}