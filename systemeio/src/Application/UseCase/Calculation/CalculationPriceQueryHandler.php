<?php

declare(strict_types=1);

namespace App\Application\UseCase\Calculation;

use App\Application\UseCase\QueryHandler;
use App\Domain\CountryTax\CountryTaxRepository;
use App\Domain\Coupon\Coupon;
use App\Domain\Coupon\CouponRepository;
use App\Domain\Product\ProductRepository;
use Exception;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class CalculationPriceQueryHandler implements QueryHandler
{
    private CountryTaxRepository $countries;
    private CouponRepository $coupons;
    private ProductRepository $products;

    public function __construct(
        CountryTaxRepository $countries,
        CouponRepository     $coupons,
        ProductRepository    $products,
    ) {
        $this->countries = $countries;
        $this->coupons = $coupons;
        $this->products = $products;
    }

    /**
     * @TODO price может уйти в -
     * @throws Exception
     */
    public function __invoke(CalculationPriceQuery $query): float
    {
        $countryTax = $this->countries->getFullTaxNumber($query->taxNumber);
        $product = $this->products->getName($query->product);
        $code = $this->coupons->getCode($query->couponCode);


        $price = $product->price()->toArray()["EUR"];

        if ($code->type() == Coupon::TYPE_PERCENT) {
            $price -= ($price / 100) * $code->amount() ;
        } elseif ($code->type() == Coupon::TYPE_FIXED) {
            $price -= $code->amount();
        }

        $price -= ($price / 100) * $countryTax->percent() ;

        return $price;
    }
}
