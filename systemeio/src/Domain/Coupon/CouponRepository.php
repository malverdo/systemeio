<?php

declare(strict_types=1);

namespace App\Domain\Coupon;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\UnexpectedResultException;

final class CouponRepository
{
    private EntityRepository $repository;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(Coupon::class);
        $this->em = $em;
    }

    /**
     * @param string|null $code
     * @return Coupon
     * @throws NoResultException|UnexpectedResultException
     */
    public function getCode(?string $code): Coupon
    {
        $nullObject = new CouponNull('', '', 0);
        $coupon = $code ? $this->repository->findOneBy(['code' => $code]) : $nullObject;

        if (is_null($coupon)) {
            throw new UnexpectedResultException(sprintf('not result coupon "%s"', $code));
        }

        return $coupon;
    }
}
