<?php

namespace WabLab\HtmlComponent\Modules\Bootstrap\V5\Component\Trait;

use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\BreakPoint;
use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\Position;

trait PaddingTrait
{

    protected array $padding = [];

    public function setPadding(int $size = 5, string $position = Position::ALL, string $breakPoint = BreakPoint::DEFAULT) : static
    {
        if($size >5 || $size < 0) {
            throw new \Exception('Padding size must be between 0 and 5');
        }
        $this->padding[$position][$breakPoint] = $size;
        return $this;
    }

    public function getPadding():array
    {
        return $this->padding;
    }
}

