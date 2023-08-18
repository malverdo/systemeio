<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Domain\CountryTax\CountryTax;
use App\Domain\Coupon\Coupon;
use App\Domain\Product\Product;
use App\Domain\ValueObject\MultiMoney;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class AppFixtures extends Fixture
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
       $countryTax = new CountryTax(19, '123456789', 'DE');
       $manager->persist($countryTax);
       $countryTax = new CountryTax(22, '12345678999', 'IT');
       $manager->persist($countryTax);
       $countryTax = new CountryTax(20, '0012302130000', 'GR');
       $manager->persist($countryTax);
       $countryTax = new CountryTax(24, '0000230123', 'FR', 'ER');
       $manager->persist($countryTax);

       $countryTax = new Coupon(Coupon::TYPE_PERCENT, 'D15', 20.20);
       $manager->persist($countryTax);
       $countryTax = new Coupon(Coupon::TYPE_FIXED, 'D16', 150.00);
       $manager->persist($countryTax);

       $countryTax = new Product(MultiMoney::fromExchange(20), 'Наушники');
       $manager->persist($countryTax);
       $countryTax = new Product(MultiMoney::fromExchange(100), 'Iphone');
       $manager->persist($countryTax);
       $countryTax = new Product(MultiMoney::fromExchange(10), 'Чехол');
       $manager->persist($countryTax);

       $manager->flush();
    }
}
