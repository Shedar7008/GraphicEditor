<?php

namespace Shop\Core;


abstract class Entity
{
    /** @var int */
    private $ID = 0;

    abstract public function getRepositoryName(): string;

    /**
     * @return int
     */
    public function getID(): int
    {
        return $this->ID;
    }

    /**
     * @param int $ID
     */
    public function setID(int $ID)
    {
        $this->ID = $ID;
    }
}