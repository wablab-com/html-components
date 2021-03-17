<?php

namespace WabLab\HtmlComponent\Modules\Bootstrap\V5\Component\Trait;

use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\BreakPoint;
use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\Justify;

trait JustifyContentTrait
{

    protected array $justifyContent = [];

    public function setJustifyContent(string $justify = Justify::START, string $breakPoint = BreakPoint::DEFAULT) : static
    {
        $this->justifyContent[$breakPoint] = $justify;
        return $this;
    }

    public function getJustifyContent():array
    {
        return $this->justifyContent;
    }
}

