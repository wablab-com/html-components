<?php

namespace WabLab\HtmlComponent\Modules\Bootstrap\V5\ToHtml;

use WabLab\HtmlBuilder\HTML\Tag\Base;
use WabLab\HtmlBuilder\HTML\Tag\Body;
use WabLab\HtmlBuilder\HTML\Tag\Footer;
use WabLab\HtmlBuilder\HTML\Tag\Head;
use WabLab\HtmlBuilder\HTML\Tag\Header;
use WabLab\HtmlBuilder\HTML\Tag\Html;
use WabLab\HtmlBuilder\HTML\Tag\Link;
use WabLab\HtmlBuilder\HTML\Tag\Main;
use WabLab\HtmlBuilder\HTML\Tag\Meta;
use WabLab\HtmlBuilder\HTML\Tag\Script;
use WabLab\HtmlBuilder\HTML\Tag\Title;
use WabLab\HtmlComponent\Component\Layout;

class LayoutBuilder
{
    private Layout $layout;

    public function __construct(Layout $layout)
    {
        $this->layout = $layout;
    }

    //
    // LEVEL 0
    //
    public function build():Html
    {
        return $this->buildHtmlTag();
    }


    //
    // LEVEL 1
    //
    protected function buildHtmlTag(): Html
    {
        return Html::create()
            ->setLang($this->layout->getLanguage())
            ->addChild( $this->buildHeadTag() )
            ->addChild( $this->buildBodyTag() );
    }


    //
    // LEVEL 2
    //
    protected function buildHeadTag(): Head
    {
        $head = Head::create()
            ->addChild( $this->buildBaseTag() )
            ->addChild( $this->buildTitleTag() );

        $this->buildMetaTags($head);
        $this->buildCssLinks($head);
        $this->buildFavIconLinkTag($head);
        return $head;
    }

    protected function buildBodyTag(): Body
    {
        $body = Body::create()
            ->addChild( $this->buildBodyHeaderTag() )
            ->addChild( $this->buildBodyMainTag() )
            ->addChild( $this->buildBodyFooterTag() );

        $this->buildBodyScriptTags($body);

        return $body;
    }

    //
    // LEVEL 3
    //
    protected function buildMetaTags(Head $head):void
    {
        $head
            ->addChild( $this->buildCharsetMetaTag() )
            ->addChild( $this->buildViewportMetaTag() )
            ->addChild( $this->buildDescriptionMetaTag() )
            ->addChild( $this->buildKeywordsMetaTag() );
    }

    private function buildCssLinks(Head $head):void
    {
        $head->addChild( $this->buildBootstrapCssLinkTag() );
        $this->buildLayoutExternalCssLinkTags($head);
    }

    private function buildBodyScriptTags(Body $body):void
    {
        $body->addChild( $this->buildBootstrapJavaScriptTag() );
        $this->buildLayoutExternalScriptTags($body);
    }

    protected function buildBaseTag(): Base
    {
        return Base::create()->setHref($this->layout->getBaseUrl());
    }

    protected function buildTitleTag(): Title
    {
        return Title::create()->setInnerText($this->layout->getPageTitle());
    }

    protected function buildBodyHeaderTag(): Header
    {
        return Header::create();
    }

    protected function buildBodyMainTag(): Main
    {
        return Main::create();
    }

    protected function buildBodyFooterTag(): Footer
    {
        return Footer::create();
    }

    //
    // LEVEL 4
    //
    protected function buildCharsetMetaTag(): Meta
    {
        return Meta::create()->setCharset($this->layout->getCharset());
    }

    protected function buildViewportMetaTag(): Meta
    {
        return Meta::create()->setName('viewport')->setContent('width=device-width, initial-scale=1');
    }

    protected function buildDescriptionMetaTag(): Meta
    {
        return Meta::create()->setName('description')->setContent($this->layout->getMetaDescription());
    }

    protected function buildKeywordsMetaTag(): Meta
    {
        return Meta::create()->setName('keywords')->setContent($this->layout->getMetaKeywords());
    }

    private function buildBootstrapCssLinkTag(): Link
    {
        return Link::create()
            ->setHref('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css')
            ->setRel('stylesheet')
            ->setAttribute('integrity', 'sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl')
            ->setAttribute('crossorigin', 'anonymous');
    }

    private function buildLayoutExternalCssLinkTags(Head $head): void
    {
        foreach ($this->layout->getExternalCss() as $cssUrl) {
            $head->addChild(
                Link::create()
                    ->setHref($cssUrl)
                    ->setRel('stylesheet')
                    ->setType('text/css')
            );
        }
    }

    private function buildBootstrapJavaScriptTag(): Script
    {
        return Script::create()
            ->setSrc('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js')
            ->setAttribute('integrity', 'sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0')
            ->setAttribute('crossorigin', 'anonymous');
    }

    private function buildLayoutExternalScriptTags(Body $body): void
    {
        foreach ($this->layout->getExternalJs() as $jsPath) {
            $body->addChild(
                Script::create()->setSrc($jsPath)
            );
        }
    }

    private function buildFavIconLinkTag(Head $head):void
    {
        $head->addChild(
            Link::create()
                ->setRel('icon')
                ->setHref($this->layout->getFavicon())
        );
    }

}