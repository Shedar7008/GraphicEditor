<?php

namespace Shop\Module\Order;


use Shop\Core\Entity;

class Order extends Entity
{
    /** @var int */
    private $deliveryID = 0;

    /** @var int */
    private $paymentID = 0;

    /** @var int */
    private $userID = 0;

    /** @var string */
    private $comment = '';

    /**
     * @return int
     */
    public function getDeliveryID(): int
    {
        return $this->deliveryID;
    }

    /**
     * @param int $deliveryID
     */
    public function setDeliveryID(int $deliveryID)
    {
        $this->deliveryID = $deliveryID;
    }

    /**
     * @return int
     */
    public function getPaymentID(): int
    {
        return $this->paymentID;
    }

    /**
     * @param int $paymentID
     */
    public function setPaymentID(int $paymentID)
    {
        $this->paymentID = $paymentID;
    }

    /**
     * @return int
     */
    public function getUserID(): int
    {
        return $this->userID;
    }

    /**
     * @param int $userID
     */
    public function setUserID(int $userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getRepositoryName(): string
    {
        return OrderRepository::class;
    }
}