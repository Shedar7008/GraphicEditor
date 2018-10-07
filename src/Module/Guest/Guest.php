<?php

namespace Shop\Module\Guest;


use Shop\Core\Entity;

class Guest extends Entity
{
    /**
     * @return string
     */
    public function getRepositoryName(): string
    {
        return GuestRepository::class;
    }
}