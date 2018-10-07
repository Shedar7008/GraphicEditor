<?php

namespace Shop\Module\Order;


use Shop\Core\Repository;

class OrderRepository extends Repository
{
    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'order_item';
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return [
            'ID',
            'deliveryID',
            'paymentID',
            'userID',
            'comment',
        ];
    }

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Order::class;
    }


}