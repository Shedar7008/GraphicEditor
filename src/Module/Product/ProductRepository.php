<?php

namespace Shop\Module\Product;


use Shop\Core\Repository;

class ProductRepository extends Repository
{
    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'Product';
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return [
            'ID',
            'name',
            'priceNetto',
            'priceBrutto',
            'imagePath',
            'color',
        ];
    }

    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Product::class;
    }

    /**
     * @return array
     */
    public function getColorList(): array
    {
        $sql = sprintf(
            'select distinct color from product'
        );

        $db = \Shop\Core\DB::getInstance();
        $result = $db->query($sql);

        $colors = [];
        foreach ($result as $row) {
            $colors[] = $row['color'];
        }

        return $colors;
    }
}