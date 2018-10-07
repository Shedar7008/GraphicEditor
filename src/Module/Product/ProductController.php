<?php

namespace Shop\Module\Product;


class ProductController
{
    /**
     * @param string $title
     * @return string
     */
    public function list(string &$title)
    {
        $title = 'Product List';

        $productRepository = ProductRepository::getInstance();

        if (array_key_exists('color', $_GET) && strlen($_GET['color']) > 0) {
            $products = $productRepository->getAll(['color' => $_GET['color']]);
        } else {
            $products = $productRepository->getAll();
        }

        $productView = new ProductView();
        $html = $productView->applyToMultiple($products);

        $colors = $productRepository->getColorList();

        $colorsHtml = '';
        $colorView = new ProductColorView();
        foreach ($colors as $color) {
            $selected = !empty($_GET['color']) && $color === $_GET['color'] ? 'selected="selected"' : '';
            $colorsHtml .= $colorView->fill([
                'COLOR' => $color,
                'SELECTED' => $selected
            ]);
        }

        $productListView = new ProductListView();
        $html = $productListView->fill([
            'PRODUCT_LIST' => $html,
            'COLORS' => $colorsHtml
        ]);

        return $html;
    }
}