<?php

declare(strict_types=1);

namespace App\Domain\Coupon;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class CouponRepository
{
    private EntityRepository $repository;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(Coupon::class);
        $this->em = $em;
    }

    public function findCode(?string $code): Coupon
    {
        return $code ? $this->repository->findOneBy(['code' => $code]) : new CouponNull('','', 0);
    }
}
