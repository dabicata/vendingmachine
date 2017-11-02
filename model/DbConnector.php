<?php
/**
 * Created by PhpStorm.
 * User: toorhax
 * Date: 10/16/17
 * Time: 3:22 PM
 */

namespace vending\model;

/**
 * This Class connects you to database and perform Queries.
 *
 * @package vending
 */
class DbConnector
{
    private $dataBase;
    const  DSN = "mysql:dbname=vending_machine;host=127.0.0.1";
    const USER = "work";
    const PASSWORD = "workpass";

    /**
     * DbConnector constructor.
     * Opens a connection to database.
     */
    public function __construct()
    {
        try {
            $this->dataBase = new \PDO(SELF::DSN, SELF::USER, SELF::PASSWORD);
            $this->dataBase->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }


    /**
     * Close the database connection.
     */
    public function closeConnection()
    {
        $this->dataBase = null;
    }

    /**
     * Takes sql and parameters for sql and performs  insert, update, delete query.
     *
     * @param $sql holds the sql.
     * @param iterable|holds $parameters holds parameters for sql
     * @return string
     */
    public function executeQuery($sql, iterable $parameters)
    {
        $query = $this->dataBase->prepare($sql);
        $counter = 1;
        foreach ($parameters as $param) {
            $query->bindValue($counter, $param);
            $counter++;
        }
        try {

            $query->execute();


        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $this->dataBase->lastInsertId();
    }

    /**
     * Takes sql and parameters for sql and performs select query.
     *
     * @param $sql holds the sql.
     * @param iterable|holds $parameters holds parameters for sql
     * @return array of the query
     */
    public function selectQuery($sql, iterable $parameters)
    {
        $query = $this->dataBase->prepare($sql);
        $counter = 1;
        foreach ($parameters as $param) {
            $query->bindValue($counter, $param);
            $counter++;
        }
        try {
            $query->execute();
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $camelCaseQuery = [];
        $result = $query->fetchAll();

        if ($result) {
            foreach ($result as $item) {
                $camelKeys = [];
                foreach ($item as $key => $value) {
                    $camelKey = lcfirst(implode('', array_map('ucfirst', explode('_', $key))));
                    $camelKeys[] = $camelKey;
                }
                $value2 = array_combine($camelKeys, $item);
                $camelCaseQuery[] = $value2;
            }
            return $camelCaseQuery;
        }
    }


    /**
     * Takes sql and parameters for sql and performs select query by id.
     *
     * @param $sql
     * @param $parameters
     * @return mixed
     */
    public function selectByIdQuery($sql, $parameters)
    {
        $query = $this->dataBase->prepare($sql);
        $counter = 1;
        foreach ($parameters as $param) {
            $query->bindValue($counter, $param);
            $counter++;
        }
        try {
            $query->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        $camelCaseQuery = [];
        $result = $query->fetch();
        if ($result) {
            foreach ($result as $key => $value) {
                $camelKey = lcfirst(implode('', array_map('ucfirst', explode('_', $key))));
                $camelKeys[] = $camelKey;
            }
            $camelCaseQuery = array_combine($camelKeys, $result);
        }
        return $camelCaseQuery;
    }
}

