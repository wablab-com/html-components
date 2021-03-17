<?php

namespace WabLab\HtmlComponent\Modules\Bootstrap\V5\Component\Trait;

use WabLab\HtmlComponent\Modules\Bootstrap\V5\Common\ContainerBreakPoint;

trait ContainerTrait
{

    protected array $container = [];

    public function setContainer(string $breakPoint = ContainerBreakPoint::DEFAULT) : static
    {
        $this->container[$breakPoint] = true;
        return $this;
    }

    public function getContainer():array
    {
        return $this->container;
    }
}

