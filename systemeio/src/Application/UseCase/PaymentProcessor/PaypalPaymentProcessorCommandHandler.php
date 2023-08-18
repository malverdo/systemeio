<?php

declare(strict_types=1);

namespace App\Application\UseCase\PaymentProcessor;

use App\Application\UseCase\CommandHandler;
use App\Infrastructure\PaymentProcessor\PaypalPaymentProcessor;
use Exception;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler]
final class PaypalPaymentProcessorCommandHandler implements CommandHandler
{
    /**
     * @throws Exception
     */
    public function __invoke(PaypalPaymentProcessorCommand $command): void
    {
        $price = (int) $command->price;
        $payment = new PaypalPaymentProcessor();
        $payment->pay($price);
    }
}
