<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 10/18/17
 * Time: 4:46 PM
 */

namespace vending\model;


class MachineDAO implements CRUDInterface
{
    public function selectAll()
    {
        $sql = 'SELECT * FROM `vending_machines`';
        $db = new namespace\DbConnector();
        $db->selectQuery($sql);
        $db->closeConnection();
    }

    public function select($machineId)
    {
        $sql = 'SELECT * FROM `vending_machines` WHERE vending_machine_id = ?';
        $db = new namespace\DbConnector();
        $db->selectQuery($sql, $machineId);
        $db->closeConnection();
    }

    public function insert($insertParam)
    {
        $sql = 'INSERT INTO `vending_machines` (`vending_machine_rows`, `vending_machine_columns`, `machine_size`, `vending_machine_date_created`) VALUES
 (?, ?, ?, now())';
        $db = new namespace\DbConnector();
        $db->executeQuery($sql, $insertParam);
        $db->closeConnection();
    }

    public function update($updateParam)
    {
        $sql = 'UPDATE `vending_machines` SET `vending_machine_rows` = ?, `vending_machine_columns` = ?, `machine_size` = ?, `vending_machine_date_updated` = now()
WHERE `vending_machines`.`vending_machine_id` = ?';
        $db = new namespace\DbConnector();
        $db->executeQuery($sql, $updateParam);
        $db->closeConnection();
    }

    public function delete($machineId)
    {
        $sql = 'DELETE FROM `vending_machines` WHERE `vending_machines`.`vending_machine_id` = ?';
        $db = new namespace\DbConnector();
        $db->executeQuery($sql, $machineId);
        $db->closeConnection();
    }
}