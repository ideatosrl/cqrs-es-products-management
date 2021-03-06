<?php

namespace Shop\Product\Event;

use Broadway\Serializer\Serializable;
use Shop\Product\ValueObject\ProductId;

class ProductCreated implements Serializable
{
    protected $productId;
    protected $barcode;
    /**
     * @var string
     */
    protected $name;
    protected $imageUrl;
    protected $brand;

    protected $createdAt;

    /**
     * ProductCreated constructor.
     *
     * @param                    $productId
     * @param string             $barcode
     * @param string             $name
     * @param string             $imageUrl
     * @param string             $brand
     * @param \DateTimeImmutable $createdAt
     */
    public function __construct(
        ProductId $productId,
        string $barcode,
        string $name,
        string $imageUrl,
        string $brand,
        \DateTimeImmutable $createdAt
    ) {
        $this->productId = $productId;
        $this->barcode = $barcode;
        $this->name = $name;
        $this->imageUrl = $imageUrl;
        $this->brand = $brand;
        $this->createdAt = $createdAt;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param array $data
     *
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new self(
            new ProductId($data['productId']),
            $data['barcode'],
            $data['name'],
            $data['imageUrl'],
            $data['brand'],
            new \DateTimeImmutable($data['createdAt'])
        );
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'productId' => (string)$this->productId,
            'name'      => $this->name,
            'barcode'   => $this->barcode,
            'imageUrl'  => $this->imageUrl,
            'brand'     => $this->brand,
            'createdAt' => $this->createdAt->format('Y-m-d\TH:i:s.uP')
        ];
    }
}
