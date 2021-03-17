<?php

namespace WabLab\HtmlComponent\Modules\Bootstrap\V5\Component\Trait;

use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\BreakPoint;
use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\Position;

trait MarginTrait
{

    protected array $margin = [];

    public function setMargin(int $size = 5, string $position = Position::ALL, string $breakPoint = BreakPoint::DEFAULT) : static
    {
        if($size >5 || $size < 0) {
            throw new \Exception('Margin size must be between 0 and 5');
        }
        $this->margin[$position][$breakPoint] = $size;
        return $this;
    }

    public function getMargin():array
    {
        return $this->margin;
    }
}

