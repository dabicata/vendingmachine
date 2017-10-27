<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 10/18/17
 * Time: 4:24 PM
 */

namespace vending\model;

use vending\model\DbConnector;

include_once 'CRUDInterface.php';
include_once '/srv/http/vendingmachine/model/DbConnector.php';


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
        $data = $db->selectQuery($sql);
        $db->closeConnection();
        return $data;

    }

    /**
     * Select cell by ID.
     * @param $cellid
     * @return mixed
     */
    public function select($cellid)
    {
        $sql = 'SELECT * FROM `cells` WHERE cell_id = ?';
        $db = new DbConnector();
        $data = $db->selectByIdQuery($sql, $cellid);
        $db->closeConnection();
        return $data;
    }

    /**
     * Select cell by  MachineID.
     * @param $machineId
     * @return mixed
     */
    public function selectCellByMachineId($machineId)
    {
        $sql = 'SELECT * FROM `cells` WHERE vending_machine_id = ?';
        $db = new DbConnector();
        $data = $db->selectQuery($sql, $machineId);
        $db->closeConnection();
        return $data;
    }


    /**
     * Insert into cells: vending_machine_id, cell_row, cell_column, combined_cell, cell_date_created.
     * @param $insertParam
     * @return string
     */
    public function insert(iterable $insertParam)
    {
        $sql = 'INSERT INTO `cells` ( `vending_machine_id`, `cell_row`, `cell_column`, `cell_date_created`)
 VALUES (?, ?, ?, now())';
        $db = new DbConnector();
        $data = $db->executeQuery($sql, $insertParam);
        $db->closeConnection();
        return $data;
    }

    /**
     * Update cells selected by ID: vending_machine_id, cell_row, cell_column, combined_cell, cell_date_updated.
     * @param $updateParam
     * @return mixed|void
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
     * @return mixed|void
     */
    public function delete($cellid)
    {
        $sql = 'DELETE FROM `cells` WHERE `cells`.`cell_id` = ?';
        $db = new DbConnector();
        $db->executeQuery($sql, $cellid);
        $db->closeConnection();
    }
}


