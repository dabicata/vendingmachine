<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 10/18/17
 * Time: 3:08 PM
 */

namespace vending\model;


interface CRUDInterface
{
    /**
     * Selects all.
     */
    public function selectAll();

    /**
     * Select by ID.
     *
     * @param $productId
     */
    public function select($productId);

    /**
     * Insert into database.
     *
     * @param $insertParam
     */
    public function insert(iterable $insertParam);

    /**
     * Update the database.
     *
     * @param iterable $updateParam
     * @return mixed
     */
    public function update(iterable $updateParam);

    /**
     * Delete from database.
     *
     * @param $productId
     * @return mixed
     */
    public function delete($productId);

}