<?php

namespace WabLab\HtmlComponent\Modules\Bootstrap\V5\Component\Trait;

use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\Align;
use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\BreakPoint;

trait AlignItemsTrait
{

    protected array $alignItems = [];

    public function setAlignItems(string $align = Align::START, string $breakPoint = BreakPoint::DEFAULT) : static
    {
        $this->alignItems[$breakPoint] = $align;
        return $this;
    }

    public function getAlignItems():array
    {
        return $this->alignItems;
    }
}

