<?php

declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\ValueObject\MultiMoney;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;


#[HasLifecycleCallbacks]
#[ORM\Entity]
#[ORM\Table(name: 'product')]
class Product
{
    #[ORM\Column(type: "integer")]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Embedded(class: "App\Domain\ValueObject\MultiMoney", columnPrefix:"price_")]
    private MultiMoney $price;

    #[ORM\Column(type: "string")]
    private string $name;

    /**
     * @param MultiMoney $price
     * @param string $name
     */
    public function __construct(MultiMoney $price, string $name)
    {
        $this->price = $price;
        $this->name = $name;
    }
}