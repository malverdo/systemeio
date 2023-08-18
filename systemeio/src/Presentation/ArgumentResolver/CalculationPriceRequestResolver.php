<?php

declare(strict_types=1);

namespace App\Presentation\ArgumentResolver;

use App\Application\Service\FormResolver;
use App\Application\Service\RequestNormalize;
use App\Domain\CountryTax\CountryTaxRepository;
use App\Presentation\Form\CalculationPriceFormType;
use App\Presentation\Request\CalculationPriceRequest;
use Doctrine\ORM\NoResultException;
use Exception;
use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;

class CalculationPriceRequestResolver implements ArgumentValueResolverInterface
{
    private FormFactoryInterface $formFactory;

    private RequestNormalize $requestNormalize;
    private FormResolver $formResolver;

    public function __construct(
        RequestNormalize     $requestNormalize,
        FormResolver         $formResolver,
        FormFactoryInterface $formFactory
    )
    {
        $this->formFactory = $formFactory;
        $this->requestNormalize = $requestNormalize;
        $this->formResolver = $formResolver;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return CalculationPriceRequest::class === $argument->getType();
    }

    /**
     * @throws Exception
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $requestArray = $this->requestNormalize->normalize($request);
        $calculation = new CalculationPriceRequest();

        $form = $this->formFactory->create(CalculationPriceFormType::class, $calculation);
        $form->submit($requestArray);

        $this->formResolver->resolver($form);

        yield $calculation;
    }

}