<?php

namespace Shop\Module\Basket;


use Shop\Core\View;

class BasketItemView extends View
{
    /**
     * @return string
     */
    protected function getTemplateName()
    {
        return 'basket_item';
    }
}