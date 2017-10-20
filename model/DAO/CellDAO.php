<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 10/18/17
 * Time: 4:24 PM
 */

namespace vending\model;

use vending\DbConnector;

include 'CRUDInterface.php';
include '../DbConnector.php';

/**
 * This class lets you do CRUD operations to cells table.
 * Class CellDAO
 * @package vending\model
 */
class CellDAO implements CRUDInterface
{
    /**
     *Select All cells
     */
    public function selectAll()
    {
        $sql = 'SELECT * FROM `cells`';
        $db = new DbConnector();
        $db->selectQuery($sql);
        $db->closeConnection();
    }

    /**
     * Select cell by ID.
     * @param $cellid
     */
    public function select($cellid)
    {
        $sql = 'SELECT * FROM `cells` WHERE cell_id = ?';
        $db = new DbConnector();
        $db->selectByIdQuery($sql, $cellid);
        $db->closeConnection();
    }

    /**
     * Insert into cells: vending_machine_id, cell_row, cell_column, combined_cell, cell_date_created.
     * @param $insertParam
     */
    public function insert(iterable $insertParam)
    {
        $sql = 'INSERT INTO `cells` ( `vending_machine_id`, `cell_row`, `cell_column`, `cell_date_created`)
 VALUES (?, ?, 0, now())';
        $db = new DbConnector();
        $db->executeQuery($sql, $insertParam);
        $db->closeConnection();
    }

    /**
     * Update cells selected by ID: vending_machine_id, cell_row, cell_column, combined_cell, cell_date_updated.
     * @param $updateParam
     */
    public function update(iterable $updateParam)
    {
        $sql = 'UPDATE `cells` SET `vending_machine_id` = ?, `cell_row` = ?, `cell_column` = ?, `cell_date_updated` = now() WHERE `cells`.`cell_id` = ?';
        $db = new DbConnector();
        $db->executeQuery($sql, $updateParam);
        $db->closeConnection();
    }

    /**
     * Delete cell by ID.
     * @param $cellid
     */
    public function delete($cellid)
    {
        $sql = 'DELETE FROM `cells` WHERE `cells`.`cell_id` = ?';
        $db = new DbConnector();
        $db->executeQuery($sql, $cellid);
        $db->closeConnection();
    }
}

$dbz = new CellDAO();
$paramupdate = [2, 112, 133, 0, 4];
$paraminsert = [2, 177, 173, 0];
$dbz->update($paramupdate);
$dbz->insert($paraminsert);

