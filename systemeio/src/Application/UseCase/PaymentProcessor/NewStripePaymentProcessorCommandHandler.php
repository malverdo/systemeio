<?php

declare(strict_types=1);

namespace App\Application\UseCase\PaymentProcessor;

use App\Application\UseCase\CommandHandler;
use App\Infrastructure\PaymentProcessor\NewStripePaymentProcessor;
use Exception;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler]
final class NewStripePaymentProcessorCommandHandler implements CommandHandler
{
    /**
     * @throws Exception
     */
    public function __invoke(NewStripePaymentProcessorCommand $command): void
    {
        $price = (int) $command->price;
        $payment = new NewStripePaymentProcessor();
        $bool = $payment->processPayment($price);

        if (!$bool) {
            throw new Exception('Too low price');
        }
    }
}
