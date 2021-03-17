<?php

namespace WabLab\HtmlComponent\Modules\Bootstrap\V5\Component;

use WabLab\HtmlComponent\Modules\Bootstrap\V5\Component\Trait\AlignItemsTrait;
use WabLab\HtmlComponent\Modules\Bootstrap\V5\Component\Trait\AlignSelfTrait;
use WabLab\HtmlComponent\Modules\Bootstrap\V5\Component\Trait\JustifyContentTrait;
use WabLab\HtmlComponent\Modules\Bootstrap\V5\Component\Trait\MarginTrait;
use WabLab\HtmlComponent\Modules\Bootstrap\V5\Component\Trait\PaddingTrait;

abstract class AbstractComponent
{
    use PaddingTrait;
    use MarginTrait;
    use AlignSelfTrait;
    use AlignItemsTrait;
    use JustifyContentTrait;
}

