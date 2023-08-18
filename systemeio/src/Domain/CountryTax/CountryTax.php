<?php

declare(strict_types=1);

namespace App\Domain\CountryTax;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[HasLifecycleCallbacks]
#[ORM\Entity]
#[ORM\Table(name: 'country_tax')]
class CountryTax
{
    #[ORM\Column(type: "integer")]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'integer')]
    private int $percent;

    #[ORM\Column(type: 'string')]
    private string $format;

    #[ORM\Column(type: 'string')]
    private string $code;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $symbol;

    #[ORM\Column(type: 'string')]
    private string $fullTaxNumber;

    /**
     * @param integer $percent
     * @param string $format
     * @param string $code
     */
    public function __construct(int $percent, string $format, string $code, ?string $symbol = null)
    {
        $this->percent = $percent;
        $this->format = $format;
        $this->code = $code;
        $this->symbol = $symbol;
        $this->fullTaxNumber = sprintf('%s%s%s', $code, $symbol, $format);
    }

    public function percent(): int
    {
        return $this->percent;
    }
}
