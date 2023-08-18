<?php

declare(strict_types=1);

namespace App\Presentation\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CalculationPriceRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public string $product;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Regex('/^[A-Z]{2,4}[0-9]+$/')]
    public string $taxNumber;

    public ?string $couponCode;

    #[Assert\NotBlank]
    #[Assert\Choice(['paypal', 'stripe', 'newstripe'])]
    public string $paymentProcessor;

}
