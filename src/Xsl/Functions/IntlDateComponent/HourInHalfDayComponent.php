<?php
declare(strict_types=1);

namespace Genkgo\Xsl\Xsl\Functions\IntlDateComponent;

use DateTimeInterface;
use Genkgo\Xsl\Xsl\Functions\Formatter\ComponentInterface;
use Genkgo\Xsl\Xsl\Functions\Formatter\PictureString;

final class HourInHalfDayComponent implements ComponentInterface
{
    /**
     * @param PictureString $pictureString
     * @param DateTimeInterface $date
     * @return string
     */
    public function format(PictureString $pictureString, DateTimeInterface $date): string
    {
        return 'hh';
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'h';
    }
}
