<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 10/18/17
 * Time: 4:46 PM
 */

namespace vending\model;

use vending\DbConnector;

include 'CRUDInterface.php';
include '../DbConnector.php';

/**
 *  * This class lets you do CRUD operations to vending_machine table.
 * Class MachineDAO
 * @package vending\model
 */
class MachineDAO implements CRUDInterface
{
    /**
     *Select All machines.
     */
    public function selectAll()
    {
        $sql = 'SELECT * FROM `vending_machines`';
        $db = new DbConnector();
        $db->selectQuery($sql);
        $db->closeConnection();
    }

    /**
     * Select machine by ID.
     * @param $machineId
     * @return array
     */
    public function select($machineId)
    {
        $sql = 'SELECT * FROM `vending_machines` WHERE vending_machine_id = ?';
        $db = new DbConnector();
        $data = $db->selectByIdQuery($sql, $machineId);
        $db->closeConnection();
        return $data;

    }

    /**
     * Insert into machines: vending_machine_rows, vending_machine_columns, machine_size, vending_machine_date_created.
     * @param $insertParam
     */
    public function insert(iterable $insertParam)
    {
        $sql = 'INSERT INTO `vending_machines` (`vending_machine_rows`, `vending_machine_columns`, `machine_size`, `vending_machine_date_created`) VALUES
 (?, ?, ?, now())';
        $db = new DbConnector();
        $db->executeQuery($sql, $insertParam);
        $db->closeConnection();
    }

    /**
     * Update machine selected by ID: vending_machine_rows, vending_machine_columns, machine_size, vending_machine_date_updated.
     * @param $updateParam
     */
    public function update(iterable $updateParam)
    {
        $sql = 'UPDATE `vending_machines` SET `vending_machine_rows` = ?, `vending_machine_columns` = ?, `machine_size` = ?, `vending_machine_date_updated` = now() 
WHERE `vending_machines`.`vending_machine_id` = ?';
        $db = new DbConnector();
        $db->executeQuery($sql, $updateParam);
        $db->closeConnection();
    }

    /**
     * Delete machine by ID.
     * @param $machineId
     */
    public function delete($machineId)
    {
        $sql = 'DELETE FROM `vending_machines` WHERE `vending_machines`.`vending_machine_id` = ?';
        $db = new DbConnector();
        $db->executeQuery($sql, $machineId);
        $db->closeConnection();
    }
}

$select = [1, 2];

$paraminsert = [123, 35, 124];
$dbz = new MachineDAO();
$dbz->select($select);
