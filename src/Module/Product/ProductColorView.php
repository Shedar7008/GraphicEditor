<?php

namespace Shop\Module\Product;


use Shop\Core\View;

class ProductColorView extends View
{
    /**
     * @return string
     */
    protected function getTemplateName()
    {
        return 'color';
    }
}