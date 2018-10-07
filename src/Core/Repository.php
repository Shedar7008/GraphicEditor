<?php

namespace Shop\Core;


abstract class Repository
{
    abstract public function getTableName(): string;

    abstract public function getFields(): array;

    abstract public function getModelClass(): string;

    private function __construct()
    {
    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        static $instance;

        if (!$instance) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * @param array $filters
     * @return array|null
     */
    public function getAll(array $filters = []): array
    {
        $where = '';
        if ($filters) {
            $fields = $this->getFields();
            $where = [];
            foreach ($filters as $key => $value) {
                if (!in_array($key, $fields)) {
                    die("Filter for \"$key\" is not allowed");
                }

                if (!is_int($value) && !is_float($value)) {
                    $value = '\'' . $value . '\'';
                }

                $where[] = $key . '=' . $value;
            }
            $where = ' where ' . implode(' and ', $where);
        }

        $sql = sprintf('select * from %s %s', $this->getTableName(), $where);

        $db = DB::getInstance();
        $result = $db->query($sql);

        $modelClass = $this->getModelClass();
        $items = [];
        foreach ($result as $row) {
            $item = new $modelClass();
            foreach ($this->getFields() as $field) {
                $methodName = 'set' . ucfirst($field);
                $item->$methodName($row[$field]);
            }
            $items[] = $item;
        }

        return $items;
    }

    /**
     * @param int $id
     * @return null|Entity
     */
    public function getByID(int $id)
    {
        $sql = sprintf(
            'select * from %s where ID=%d',
            $this->getTableName(), $id
        );

        $db = DB::getInstance();
        $result = $db->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            return null;
        }

        $modelClass = $this->getModelClass();

        $item = new $modelClass();
        foreach ($this->getFields() as $field) {
            $methodName = 'set' . ucfirst($field);
            $item->$methodName($row[$field]);
        }

        return $item;
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getMultipleByID(array $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        $ids = implode(', ', $ids);

        $sql = sprintf(
            'select * from %s where ID in (%s)',
            $this->getTableName(), $ids
        );

        $db = DB::getInstance();
        $result = $db->query($sql);

        $modelClass = $this->getModelClass();
        $items = [];
        foreach ($result as $row) {
            $item = new $modelClass();
            foreach ($this->getFields() as $field) {
                $methodName = 'set' . ucfirst($field);
                $item->$methodName($row[$field]);
            }
            $items[] = $item;
        }

        return $items;
    }

    /**
     * @param Entity $entity
     * @return int
     */
    public function addItem(Entity $entity): int
    {
        $columns = implode(',', $this->getFields());

        $values = [];
        foreach ($this->getFields() as $field) {
            $methodName = 'get' . ucfirst($field);
            $value = $entity->$methodName();

            if (is_int($value) || is_float($value)) {
                $values[] = $value;
            } else {
                $values[] = '\'' . $value . '\'';
            }
        }
        $values = implode(',', $values);

        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $this->getTableName(), $columns, $values
        );


        $db = DB::getInstance();
        $db->query($sql);

        return $db->getInsertedID();
    }

    /**
     * @param Entity $entity
     */
    public function updateItem(Entity $entity)
    {
        $updates = [];
        foreach ($this->getFields() as $field) {
            $methodName = 'get' . ucfirst($field);
            $value = $entity->$methodName();

            if (!is_int($value) && !is_float($value)) {
                $value = '\'' . $value . '\'';
            }

            $updates[] = $field . '=' . $value;
        }
        $updates = implode(',', $updates);

        $sql = sprintf(
            'update %s set %s where ID=%d',
            $this->getTableName(), $updates, $entity->getID()
        );

        $db = DB::getInstance();
        $db->query($sql);
    }

    /**
     * @param int $id
     * @return bool|\mysqli_result
     */
    public function deleteItem(int $id)
    {
        $sql = sprintf(
            'delete from %s where ID=%d',
            $this->getTableName(), $id
        );

        $db = DB::getInstance();
        return $db->query($sql);
    }

    public function startTransaction()
    {
        $db = DB::getInstance();
        $db->startTransaction();
    }

    public function commitTransaction()
    {
        $db = DB::getInstance();
        $db->commitTransaction();
    }

    public function rollbackTransaction()
    {
        $db = DB::getInstance();
        $db->rollbackTransaction();
    }
}