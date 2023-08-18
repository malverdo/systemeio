<?php

declare(strict_types=1);

namespace App\Application\UseCase\Calculation;


use App\Infrastructure\Bus\Query;

final class CalculationPriceQuery implements Query
{
    public string $product;

    public string $taxNumber;
    public string $paymentProcessor;
    public ?string $couponCode;

    public function __construct(
        $product,
        $taxNumber,
        $paymentProcessor,
        $couponCode = null,
    ) {
        $this->product = $product;
        $this->taxNumber = $taxNumber;
        $this->paymentProcessor = $paymentProcessor;
        $this->couponCode = $couponCode;
    }
}
