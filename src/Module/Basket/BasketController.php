<?php

namespace Shop\Module\Basket;


use Shop\Module\Product\Product;
use Shop\Module\Product\ProductRepository;

class BasketController
{
    /**
     * @return string
     */
    public function add()
    {
        if (!array_key_exists('productID', $_GET)) {
            return '';
        }

        $prodID = (int)($_GET['productID']);
        $bRepository = BasketRepository::getInstance();
        $basketItems = $bRepository->getAll([
            'productID' => $prodID,
            'guestID' => $_COOKIE['GUEST_ID'],
            'orderID' => 0,
        ]);

        if ($basketItems) {
            /** @var BasketItem $basketItem */
            $basketItem = $basketItems[0];
            $basketItem->setQuantity($basketItem->getQuantity() + 1);
            $bRepository->updateItem($basketItem);
            return '';
        }

        $basketItem = new BasketItem();
        $basketItem->setProductID($prodID);
        $basketItem->setGuestID($_COOKIE['GUEST_ID']);
        $basketItem->setQuantity(1);

        $bRepository->addItem($basketItem);

        return '';
    }

    /**
     * @param string $title
     * @return string
     */
    public function list(string &$title)
    {
        $title = 'Basket';

        $basketRepository = BasketRepository::getInstance();
        $basketItems = $basketRepository->getAll([
            'guestID' => $_COOKIE['GUEST_ID'],
            'orderID' => 0,
        ]);

        if (empty($basketItems)) {
            return 'Your basket is empty.';
        }

        $prodIds = [];
        $prodToBasket = [];
        foreach ($basketItems as $bItem) {
            /** @var BasketItem $bItem */
            $prodIds[] = $bItem->getProductID();
            $prodToBasket[$bItem->getProductID()] = $bItem;
        }

        $productRepository = ProductRepository::getInstance();
        $products = $productRepository->getMultipleByID($prodIds);

        $basketItemView = new BasketItemView();

        $html = '';

        if (!is_array($products)) {
            return 'Your basket is empty.';
        }

        $totalPrice = 0;
        foreach ($products as $product) {
            /** @var  Product $product */
            $itemHtml = $basketItemView->apply($product);
            $basketItem = $prodToBasket[$product->getID()];
            $itemHtml = $basketItemView->fill([
                'QUANTITY' => $basketItem->getQuantity(),
                'B_ID' => $basketItem->getID()
            ], $itemHtml);
            $html .= $itemHtml;

            $totalPrice += $product->getPriceBrutto() * $prodToBasket[$product->getID()]->getQuantity();
        }

        $basketView = new BasketView();
        $html = $basketView->fill([
            'BASKET_ITEM' => $html,
            'PRICENETTO' => $totalPrice
        ]);

        return $html;
    }

    /**
     * @return string
     */
    public function remove()
    {
        if (!array_key_exists('id', $_GET)) {
            return '';
        }

        $bID = (int)($_GET['id']);
        $basketRepository = BasketRepository::getInstance();
        $basketRepository->deleteItem($bID);

        $title = '';
        return $this->list($title);
    }
}