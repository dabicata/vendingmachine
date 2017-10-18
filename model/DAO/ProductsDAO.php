<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 10/18/17
 * Time: 10:33 AM
 */

namespace vending\model;
include 'CRUDInterface.php';
include '../DbConnector.php';

class ProductsDAO implements CRUDInterface
{
    public function selectAll()
    {
        $sql = 'SELECT * FROM `products`';
        $db = new DbConnector();
        $db->selectQuery($sql);
        $db->closeConnection();
    }

    public function select($productId)
    {
        $sql = 'SELECT * FROM `products` WHERE product_id = ?';
        $db = new DbConnector();
        $db->selectQuery($sql, $productId);
        $db->closeConnection();
    }

    public function insert($insertParam)
    {
        $sql = 'INSERT INTO `products` (`product_type_id`, `product_price`, `product_expire_date`, 
                    `product_size`, `cell_id`, `product__date_created`)
                    VALUES (?, ?, ?, ?, ?, now() )';
        $db = new DbConnector();
        $db->executeQuery($sql, $insertParam);
        $db->closeConnection();
    }

    public function update($updateParam)
    {
        $sql = 'UPDATE `products` SET `product_type_id` = ?, `product_price` = ?, `product_expire_date` = ?, `product_size` = ?, 
                  `cell_id` = ?, `product_date_updated` = now() WHERE `products`.`product_id` = ?';
        $db = new DbConnector();
        $db->executeQuery($sql, $updateParam);
        $db->closeConnection();
    }

    public function delete($productId)
    {
        $sql = 'DELETE FROM `products` WHERE `products`.`product_id` = ?';
        $db = new DbConnector();
        $db->executeQuery($sql, $productId);
        $db->closeConnection();
    }
}