<?php

declare(strict_types=1);

namespace App\Domain\CountryTax;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\UnexpectedResultException;

final class CountryTaxRepository
{
    private EntityRepository $repository;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(CountryTax::class);
        $this->em = $em;
    }

    /**
     * @throws NoResultException
     * @throws UnexpectedResultException
     */
    public function getFullTaxNumber(string $taxNumber): CountryTax
    {
        if (!$countryTax = $this->repository->findOneBy(['fullTaxNumber' => $taxNumber])) {
            throw new UnexpectedResultException(sprintf('not result "%s"', $taxNumber));
        }

        return $countryTax;
    }
}
