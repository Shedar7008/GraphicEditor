<?php

namespace Shop\Module\Product;


use Shop\Core\View;

class ProductView extends View
{
    /**
     * @return string
     */
    protected function getTemplateName()
    {
        return 'product';
    }
}