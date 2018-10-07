<?php

namespace Shop\Module\Product;


use Shop\Core\Entity;

class Product extends Entity
{
    /** @var string */
    private $name = '';

    /** @var double */
    private $priceNetto = 0.0;

    /** @var double */
    private $priceBrutto = 0.0;

    /** @var string */
    private $imagePath = '';

    /** @var string */
    private $color ='';

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPriceNetto(): float
    {
        return $this->priceNetto;
    }

    /**
     * @param float $priceNetto
     */
    public function setPriceNetto(float $priceNetto)
    {
        $this->priceNetto = $priceNetto;
    }

    /**
     * @return float
     */
    public function getPriceBrutto(): float
    {
        return $this->priceBrutto;
    }

    /**
     * @param float $priceBrutto
     */
    public function setPriceBrutto(float $priceBrutto)
    {
        $this->priceBrutto = $priceBrutto;
    }

    /**
     * @return string
     */
    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     */
    public function setImagePath(string $imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color)
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getRepositoryName(): string
    {
        return ProductRepository::class;
    }
}