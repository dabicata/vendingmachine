<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 10/18/17
 * Time: 10:33 AM
 */

namespace vending\model;

use vending\DbConnector;

include 'CRUDInterface.php';
include '../DbConnector.php';

/**
 * This class lets you do CRUD operations to product table.
 * Class ProductsDAO
 * @package vending\model
 */
class ProductsDAO implements CRUDInterface
{
    /**
     * Selects all products.
     */
    public function selectAll()
    {
        $sql = 'SELECT * FROM `products`';
        $db = new DbConnector();
        $db->selectQuery($sql);
        $db->closeConnection();
    }

    /**
     * Select Product by ID.
     * @param $productId
     */
    public function select($productId)
    {
        $sql = 'SELECT * FROM `products` WHERE product_id = ?';
        $db = new DbConnector();
        $db->selectQuery($sql, $productId);
        $db->closeConnection();
    }

    /**
     * Insert into Products: product_type_id, product_price, product_expire_date,
     * product_size, cell_id, product__date_created.
     * @param $insertParam
     */
    public function insert($insertParam)
    {
        $sql = 'INSERT INTO `products` (`product_type_id`, `product_price`, `product_expire_date`, 
                    `product_size`, `cell_id`, `product__date_created`)
                    VALUES (?, ?, ?, ?, ?, now() )';
        $db = new DbConnector();
        $db->executeQuery($sql, $insertParam);
        $db->closeConnection();
    }

    /**
     * Update Product selected by ID : product_type_id, product_price, product_expire_date, product_size,
    cell_id, product_date_updated.
     * @param $updateParam
     */
    public function update($updateParam)
    {
        $sql = 'UPDATE `products` SET `product_type_id` = ?, `product_price` = ?, `product_expire_date` = ?, `product_size` = ?, 
                  `cell_id` = ?, `product_date_updated` = now() WHERE `products`.`product_id` = ?';
        $db = new DbConnector();
        $db->executeQuery($sql, $updateParam);
        $db->closeConnection();
    }

    /**Delete product by ID.
     * @param $productId
     */
    public function delete($productId)
    {
        $sql = 'DELETE FROM `products` WHERE `products`.`product_id` = ?';
        $db = new DbConnector();
        $db->executeQuery($sql, $productId);
        $db->closeConnection();
    }
}