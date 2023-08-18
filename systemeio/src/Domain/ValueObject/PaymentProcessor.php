<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use InvalidArgumentException;
use ReflectionClass;
use function in_array;

final class PaymentProcessor
{
    public const PAYPAL = 'paypal';

    public const STRIPE = 'stripe';

    public const NEWSTRIPE = 'newstripe';


    public const AVAILABLE = [
        self::NEWSTRIPE,
        self::STRIPE,
        self::PAYPAL,
    ];
}
