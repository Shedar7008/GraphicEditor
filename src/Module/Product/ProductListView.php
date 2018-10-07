<?php

namespace Shop\Module\Product;


use Shop\Core\View;

class ProductListView extends View
{
    /**
     * @return string
     */
    protected function getTemplateName()
    {
        return 'product_list';
    }
}