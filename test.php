<?php

use WabLab\HtmlBuilder\HTML\Renderer\HtmlTagRenderer;
use WabLab\HtmlBuilder\HTML\Renderer\RendererMapper;
use WabLab\HtmlBuilder\HTML\Tag\AbstractTag;
use WabLab\HtmlComponent\Component\Layout;
use WabLab\HtmlComponent\Modules\Bootstrap\V5\ToHtml\LayoutBuilder;

require __DIR__.'/vendor/autoload.php';

$layout = new Layout();
$builder = new LayoutBuilder($layout);

$htmlTag = $builder->build();

$rendererMapper = new RendererMapper();
$rendererMapper->register(AbstractTag::class, HtmlTagRenderer::class);

$htmlTagRenderer = new HtmlTagRenderer($rendererMapper, $htmlTag);

echo $htmlTagRenderer->render();

