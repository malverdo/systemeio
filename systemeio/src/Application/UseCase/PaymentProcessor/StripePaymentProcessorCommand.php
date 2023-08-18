<?php

declare(strict_types=1);

namespace App\Application\UseCase\PaymentProcessor;


use App\Infrastructure\Bus\Command;

final class StripePaymentProcessorCommand implements Command
{
    public float $price;

    public function __construct(
        float $price
    ) {
        $this->price = $price;
    }
}
