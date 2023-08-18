<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Exception;

#[ORM\Embeddable]
class MultiMoney
{
    #[ORM\Column(type: "decimal", precision: 9, scale: 2, nullable: true)]
    private float $rubAmount;

    #[ORM\Column(type: "decimal", precision: 9, scale: 2, nullable: true)]
    private float $usdAmount;

    #[ORM\Column(type: "decimal", precision: 9, scale: 2, nullable: true)]
    private float $eurAmount;

    /**
     * @TODO iso-currency https://github.com/fortis/iso-currency
     * @param float $rubAmount
     * @param float $usdAmount
     * @param float $eurAmount
     */
    private function __construct(float $rubAmount, float $usdAmount, float $eurAmount)
    {
        $this->rubAmount = $rubAmount;
        $this->usdAmount = $usdAmount;
        $this->eurAmount = $eurAmount;
    }

    /**
     * @TODO iso-currency https://github.com/fortis/iso-currency
     * @throws Exception
     */
    public static function fromExchange(float $money, ?object $exchanger = null): self
    {
        $rub = $money;
        $usd = $money;
        $eur = $money;

        return new self($rub, $usd, $eur);
    }

    public function toArray(): array
    {
        return [
            "RUB" => $this->rubAmount,
            "USD" => $this->usdAmount,
            "EUR" => $this->eurAmount,
        ];
    }
}
