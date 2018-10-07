<?php

namespace Shop\Module\Basket;


use Shop\Core\Repository;

class BasketRepository extends Repository
{
    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'basket_item';
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return [
            'ID',
            'productID',
            'guestID',
            'orderID',
            'quantity',
        ];
    }

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return BasketItem::class;
    }
}