<?php

namespace vending\model\DAO;

use vending\model\DbConnector;

include_once __DIR__ . '/CRUDInterface.php';
include_once __DIR__ . '/../DbConnector.php';

/**
 *  * This class lets you do CRUD operations to vending_machine table.
 *
 * @package vending\model
 */
class MachineDAO implements CRUDInterface
{

    /**
     *Select All machines.
     **/
    public function selectAll()
    {
        $sql = 'SELECT * FROM `vending_machines` ORDER BY vending_machine_id DESC ';
        $db = new DbConnector();
        $data = $db->selectAllQuery($sql);
        $db->closeConnection();


        return $data;
    }

    /**
     * Select machine by ID.
     *
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
     * Insert into machines: vending_machine_rows, vending_machine_columns, vending_machine_size, vending_machine_date_created,
     * vending_machine_name, vending_machine_desc, vending_machine_status_id.
     *
     * @param $insertParam
     * @return string
     */
    public function insert(iterable $insertParam)
    {
        $sql = 'INSERT INTO `vending_machines` (`vending_machine_rows`, `vending_machine_columns`, `vending_machine_size`, ' .
            '`vending_machine_name`,`vending_machine_desc`, `vending_machine_status_id`, ' .
            '`vending_machine_date_created`) VALUES (?, ?, ?, ?, ?, ?, now())';
        $db = new DbConnector();
        $data = $db->executeQuery($sql, $insertParam);
        $db->closeConnection();

        return $data;
    }

    /**
     * Update machine selected by ID: vending_machine_rows, vending_machine_columns, vending_machine_size, vending_machine_date_updated.
     *
     * @param $updateParam
     * @return mixed|void
     */
    public function update(iterable $updateParam)
    {
        $sql = 'UPDATE `vending_machines` SET `vending_machine_rows` = ?, `vending_machine_columns` = ?, ' .
            '`vending_machine_size` = ?,`vending_machine_status_id` = ?, `vending_machine_date_updated` = now()' .
            ' WHERE `vending_machines`.`vending_machine_id` = ?';
        $db = new DbConnector();
        $db->executeQuery($sql, $updateParam);
        $db->closeConnection();
    }

    /**
     * Delete machine by ID.
     *
     * @param $machineId
     * @return mixed|void
     */
    public function delete($machineId)
    {
        $sql = 'DELETE FROM `vending_machines` WHERE `vending_machines`.`vending_machine_id` = ?';
        $db = new DbConnector();
        $db->executeQuery($sql, $machineId);
        $db->closeConnection();
    }
}
