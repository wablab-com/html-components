<?php

namespace WabLab\HtmlComponent\Modules\Bootstrap\V5\Component\Trait;

use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\Align;
use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\BreakPoint;

trait AlignSelfTrait
{

    protected array $alignSelf = [];

    public function setAlignSelf(string $align = Align::START, string $breakPoint = BreakPoint::DEFAULT) : static
    {
        $this->alignSelf[$breakPoint] = $align;
        return $this;
    }

    public function getAlignSelf():array
    {
        return $this->alignSelf;
    }
}

