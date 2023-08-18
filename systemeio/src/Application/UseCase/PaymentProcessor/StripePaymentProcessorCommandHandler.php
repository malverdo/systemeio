<?php

declare(strict_types=1);

namespace App\Application\UseCase\PaymentProcessor;

use App\Application\UseCase\CommandHandler;
use App\Infrastructure\PaymentProcessor\StripePaymentProcessor;
use Exception;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class StripePaymentProcessorCommandHandler implements CommandHandler
{
    /**
     * @throws Exception
     */
    public function __invoke(StripePaymentProcessorCommand $command): void
    {
        $price = (int) $command->price;
        $payment = new StripePaymentProcessor();
        $bool = $payment->processPayment($price);

        if (!$bool) {
            throw new Exception('Too low price');
        }
    }
}
