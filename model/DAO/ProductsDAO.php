<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 10/18/17
 * Time: 10:33 AM
 */

namespace vending\model;


include_once 'CRUDInterface.php';
include_once '/srv/http/vendingmachine/model/DbConnector.php';

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
        $data = $db->selectQuery($sql);
        $db->closeConnection();
        return $data;
    }
    /**
     * Select Product by ID.
     * @param $productId
     * @return mixed
     */
    public function select($productId)
    {
        $sql = 'SELECT * FROM `products` WHERE product_id = ?';
        $db = new DbConnector;
        $data = $db->selectByIdQuery($sql, $productId);
        $db->closeConnection();
        return $data;

    }

    /**
     * @param $cellId
     * @return mixed
     */
    public function selectProductByCellId($cellId)
    {
        $sql = 'SELECT * FROM `products` WHERE cell_id = ? ORDER BY product_expire_date DESC';
        $db = new DbConnector;
        $data = $db->selectQuery($sql, $cellId);
        $db->closeConnection();
        return $data;

    }

    /**
     * Insert into Products: product_type_id, product_price, product_expire_date,
     * product_size, cell_id, product__date_created.
     * @param $insertParam
     * @return string
     */
    public function insert(iterable $insertParam)
    {
        $sql = 'INSERT INTO `products` (`product_type_id`, `product_price`, `product_expire_date`, 
                    `product_size`, `cell_id`, `product_date_created`)
                    VALUES (?, ?, ?, ?, ?, now() )';
        $db = new DbConnector();
        $data = $db->executeQuery($sql, $insertParam);
        $db->closeConnection();
        return $data;
    }

    /**
     * Update Product selected by ID : product_type_id, product_price, product_expire_date, product_size,
     * cell_id, product_date_updated.
     * @param $updateParam
     * @return mixed|void
     */
    public function update(iterable $updateParam)
    {
        $sql = 'UPDATE `products` SET `product_type_id` = ?, `product_price` = ?, `product_expire_date` = ?, `product_size` = ?, 
                  `cell_id` = ?, `product_date_updated` = now() WHERE `products`.`product_id` = ?';
        $db = new DbConnector();
        $db->executeQuery($sql, $updateParam);
        $db->closeConnection();

    }

    /**Delete product by ID.
     * @param $productId
     * @return mixed|void
     */
    public function delete($productId)
    {
        $sql = 'DELETE FROM `products` WHERE `products`.`product_id` = ? LIMIT 1';
        $db = new DbConnector();
        $db->executeQuery($sql, $productId);
        $db->closeConnection();
    }

    /**
     * Delete product by expire date.
     * @param $expiredProduct
     */
    public function deleteExpired($expiredProduct)
    {
        $sql = 'DELETE FROM `products` WHERE `products`.`product_expire_date` > now()';
        $db = new DbConnector();
        $db->executeQuery($sql, $expiredProduct);
        $db->closeConnection();
    }
}