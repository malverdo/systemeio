<?php

declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\CountryTax\CountryTax;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

final class ProductRepository
{
    private EntityRepository $repository;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(Product::class);
        $this->em = $em;
    }

    /**
     * @throws NoResultException
     */
    public function getName(string $name): Product
    {
        if (!$product = $this->repository->findOneBy(['name' => $name])) {
            throw new NoResultException();
        }

        return $product;
    }
}
