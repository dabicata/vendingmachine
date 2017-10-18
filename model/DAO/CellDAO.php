<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 10/18/17
 * Time: 4:24 PM
 */

namespace vending\model;
include 'CRUDInterface.php';
include '../DbConnector.php';

class CellDAO implements CRUDInterface
{
    public function selectAll()
    {
        $sql = 'SELECT * FROM `cells`';
        $db = new namespace\DbConnector();
        $db->selectQuery($sql);
        $db->closeConnection();
    }

    public function select($cellid)
    {
        $sql = 'SELECT * FROM `cells` WHERE cell_id = ?';
        $db = new namespace\DbConnector();
        $db->executeQuery($sql, $cellid);
        $db->closeConnection();
    }

    public function insert($insertParam)
    {
        $sql = 'INSERT INTO `cells` ( `vending_machine_id`, `cell_row`, `cell_column`, `combined_cell`, `cell_date_created`)
 VALUES (?, ?, ?, ?, now())';
        $db = new namespace\DbConnector();
        $db->executeQuery($sql, $insertParam);
        $db->closeConnection();
    }

    public function update($updateParam)
    {
        $sql = 'UPDATE `cells` SET `vending_machine_id` = ?, `cell_row` = ?, `cell_column` = ?, `combined_cell` = ?, `cell_date_updated` = now() WHERE `cells`.`cell_id` = ?';
        $db = new namespace\DbConnector();
        $db->executeQuery($sql, $updateParam);
        $db->closeConnection();
    }

    public function delete($cellid)
    {
        $sql = 'DELETE FROM `cells` WHERE `cells`.`cell_id` = ?';
        $db = new namespace\DbConnector();
        $db->executeQuery($sql, $cellid);
        $db->closeConnection();
    }
}

$cell = new CellDAO();
$cell->insert(array(255, 255, 255, 0));