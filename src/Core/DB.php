<?php

namespace Shop\Core;


use mysqli;
use RuntimeException;

class DB
{
    /** @var mysqli */
    private $mysqli;

    private function __construct()
    {
        $this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DATABASE);
    }

    /**
     * @return DB
     */
    public static function getInstance()
    {
        static $DB;

        if (!$DB) {
            $DB = new self();
        }

        return $DB;
    }

    /**
     * @param string $sql
     * @return bool|\mysqli_result
     */
    public function query(string $sql)
    {
        $result = $this->mysqli->query($sql);
        if ($result === false) {
            throw new RuntimeException($this->mysqli->error);
        }

        return $result;
    }

    /**
     * Method to create tables
     * @param string $sql
     */
    public function multiQuery(string $sql)
    {
        $this->mysqli->multi_query($sql);
        while ($this->mysqli->more_results()) {
            $this->mysqli->next_result();
        }
    }

    /**
     * @return mixed
     */
    public function getInsertedID()
    {
        return $this->mysqli->insert_id;
    }

    public function startTransaction()
    {
        $this->mysqli->begin_transaction();
    }

    public function commitTransaction()
    {
        $this->mysqli->commit();
    }

    public function rollbackTransaction()
    {
        $this->mysqli->rollback();
    }
}