<?php

declare(strict_types=1);

namespace App\Domain\Coupon;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[HasLifecycleCallbacks]
#[ORM\Entity]
#[ORM\Table(name: 'coupon')]
class Coupon
{
    public const TYPE_PERCENT = 'percent';
    public const TYPE_FIXED = 'fixed';

    #[ORM\Column(type: "integer")]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $type;

    #[ORM\Column(type: 'string')]
    private string $code;

    #[ORM\Column(type: "decimal", precision: 9, scale: 2)]
    private float $amount;

    /**
     * @param string $type
     * @param string $code
     * @param float $amount
     */
    public function __construct(string $type, string $code, float $amount)
    {
        $this->type = $type;
        $this->code = $code;
        $this->amount = $amount;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function amount(): float
    {
        return $this->amount;
    }
}
