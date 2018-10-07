<?php

namespace Shop\Module\Order;


use Shop\Core\View;

class OrderView extends View
{
    /**
     * @return string
     */
    protected function getTemplateName()
    {
        return 'order';
    }
}