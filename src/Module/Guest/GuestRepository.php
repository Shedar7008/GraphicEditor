<?php

namespace Shop\Module\Guest;


use Shop\Core\Repository;

class GuestRepository extends Repository
{
    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'Guest';
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return [
            'ID',
        ];
    }

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Guest::class;
    }
}