<?php

declare(strict_types=1);

namespace App\Presentation\Controller;


use App\Application\Service\ResponseFactory;
use App\Application\UseCase\Calculation\CalculationPriceQuery;
use App\Application\UseCase\PaymentProcessor\NewStripePaymentProcessorCommand;
use App\Application\UseCase\PaymentProcessor\PaypalPaymentProcessorCommand;
use App\Application\UseCase\PaymentProcessor\StripePaymentProcessorCommand;
use App\Domain\ValueObject\PaymentProcessor;
use App\Infrastructure\Bus\CommandBus;
use App\Infrastructure\Bus\QueryBus;
use App\Presentation\Request\CalculationPriceRequest;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

#[Route("/payment")]
class PaymentProcessorController
{
    private ResponseFactory $responseFactory;

    private CommandBus $commandBus;
    private QueryBus $queryBus;

    public function __construct(ResponseFactory $responseFactory, CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->responseFactory = $responseFactory;
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    /**
     * @throws Throwable
     */
    #[Route('/processor', name: 'payment_processor', methods: ['POST'])]
    public function calculationPrice(CalculationPriceRequest $calculationPriceRequest): JsonResponse
    {
        try {
            $query = new CalculationPriceQuery(
                $calculationPriceRequest->product,
                $calculationPriceRequest->taxNumber,
                $calculationPriceRequest->paymentProcessor,
                $calculationPriceRequest->couponCode ?? null,
            );
            $price = $this->queryBus->handle($query);

            switch ($calculationPriceRequest->paymentProcessor) {
                case PaymentProcessor::PAYPAL:
                    $this->commandBus->handle(new PaypalPaymentProcessorCommand($price));
                    break;
                case PaymentProcessor::STRIPE:
                    $this->commandBus->handle(new StripePaymentProcessorCommand($price));
                    break;
                case PaymentProcessor::NEWSTRIPE:
                    $this->commandBus->handle(new NewStripePaymentProcessorCommand($price));
                    break;
            }


            return $this->responseFactory->success();
        } catch (Exception $exception) {
            return $this->responseFactory->error();
        }
    }

}