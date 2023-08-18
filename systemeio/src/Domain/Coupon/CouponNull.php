<?php

declare(strict_types=1);

namespace App\Domain\Coupon;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

class CouponNull extends Coupon
{
    public function __construct(string $type, string $code, float $amount)
    {
        parent::__construct($type, $code, $amount);
    }

    public function isNull(): bool
    {
        return true;
    }

}