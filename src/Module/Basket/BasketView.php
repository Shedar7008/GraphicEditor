<?php

namespace Shop\Module\Basket;


use Shop\Core\View;

class BasketView extends View
{
    /**
     * @return string
     */
    protected function getTemplateName()
    {
        return 'basket';
    }
}