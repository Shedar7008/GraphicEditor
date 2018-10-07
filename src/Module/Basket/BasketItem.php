<?php

namespace Shop\Module\Basket;


use Shop\Core\Entity;

class BasketItem extends Entity
{
    /** @var int */
    private $productID = 0;

    /** @var int */
    private $guestID = 0;

    /** @var int */
    private $orderID = 0;

    /** @var int */
    private $quantity = 0;

    /**
     * @return int
     */
    public function getProductID(): int
    {
        return $this->productID;
    }

    /**
     * @param int $productID
     */
    public function setProductID(int $productID)
    {
        $this->productID = $productID;
    }

    /**
     * @return int
     */
    public function getGuestID(): int
    {
        return $this->guestID;
    }

    /**
     * @param int $guestID
     */
    public function setGuestID(int $guestID)
    {
        $this->guestID = $guestID;
    }

    /**
     * @return int
     */
    public function getOrderID(): int
    {
        return $this->orderID;
    }

    /**
     * @param int $orderID
     */
    public function setOrderID(int $orderID)
    {
        $this->orderID = $orderID;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getRepositoryName(): string
    {
        return BasketRepository::class;
    }
}