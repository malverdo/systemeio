<?php

declare(strict_types=1);

namespace App\Presentation\Controller;


use App\Application\Service\ResponseFactory;
use App\Application\UseCase\Calculation\CalculationPriceQuery;
use App\Infrastructure\Bus\QueryBus;
use App\Presentation\Request\CalculationPriceRequest;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/calculation")]
class CalculationController
{
    private ResponseFactory $responseFactory;

    private QueryBus $queryBus;

    public function __construct(ResponseFactory $responseFactory, QueryBus $queryBus)
    {
        $this->responseFactory = $responseFactory;
        $this->queryBus = $queryBus;
    }

    #[Route('/price', name: 'calculation_price', methods: ['POST'])]
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

            return $this->responseFactory->success($price);
        } catch (Exception $exception) {
            return $this->responseFactory->error([$exception->getMessage()]);
        }
    }

}