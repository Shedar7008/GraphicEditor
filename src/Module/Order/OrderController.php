<?php

namespace Shop\Module\Order;


use Shop\Module\Basket\BasketItem;
use Shop\Module\Basket\BasketRepository;
use Shop\Module\User\User;
use Shop\Module\User\UserRepository;

class OrderController
{
    /**
     * @return string
     * @throws \Exception
     */
    public function add()
    {
        if (!$_POST) {
            throw new \Exception('No fields provided');
        }

        $userRepository = UserRepository::getInstance();
        /** @var User $user */
        $user = $userRepository->getUser();
        if (!$user) {
            throw new \Exception('Only authorized user can create an order');
        }

        $deliveryID = $_POST['deliveryID'] ?? null;
        $paymentID = $_POST['paymentID'] ?? null;
        $comment = $_POST['comment'] ?? null;

        if (!$deliveryID) {
            throw new \Exception('Delivery system is required');
        }
        if (!$paymentID) {
            throw new \Exception('Payment system is required');
        }

        $basketRepository = BasketRepository::getInstance();
        $basketItems = $basketRepository->getAll([
            'guestID' => $_COOKIE['GUEST_ID'],
            'orderID' => 0,
        ]);
        if(!$basketItems){
            throw new \Exception('Basket is empty');
        }

        $basketRepository->startTransaction();

        $order = new Order();
        $order->setUserID($user->getID());
        $order->setDeliveryID($deliveryID);
        $order->setPaymentID($paymentID);
        $order->setComment($comment);

        $orderRepository = OrderRepository::getInstance();
        $orderID = $orderRepository->addItem($order);
        if (empty($orderID) || !is_int($orderID)) {
            $basketRepository->rollbackTransaction();
            throw new \Exception('Order creation failed!');
        }

        /** @var BasketItem $basketItem */
        foreach($basketItems as $basketItem){
            $basketItem->setOrderID($orderID);
            $basketRepository->updateItem($basketItem);
        }

        $basketRepository->commitTransaction();

        return 'Order created! ID = ' . $orderID . '.';
    }

    /**
     * @param string $title
     * @return string
     * @throws \Exception
     */
    public function detail(string &$title)
    {
        $title = 'Order';

        $userRepository = UserRepository::getInstance();
        $user = $userRepository->getUser();
        if(!$user){
            throw new \Exception(
                'Please <a href="?module=user&method=login">login</a>'
                . ' or <a href="?module=user&method=register">register</a>'
            );
        }

        $orderView = new OrderView();
        $html = $orderView->fill();

        return $html;
    }
}