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

    public function selectAll();

    public function select($productId);

    public function insert($insertParam);

    public function update($updateParam);

    public function delete($productId);

}