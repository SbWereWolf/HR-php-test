<?php


namespace App\Presentation;

use App\Model\Product;
use App\Model\Vendor;

class ProductDetail
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $price;
    /**
     * @var string
     */
    private $vendor;

    private function __construct(
        int $id, string $name, int $price, string $supplier)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->vendor = $supplier;
    }

    public static function make(Product $product, Vendor $vendor)
    {
        $id = (int)$product->id;
        $name = (string)$product->name;
        $price = (int)$product->price;
        $supplier = (string)$vendor->name;

        return new static($id, $name, $price, $supplier);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getVendor(): string
    {
        return $this->vendor;
    }

}