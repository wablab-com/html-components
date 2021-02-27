<?php

namespace WabLab\HtmlComponent;


use WabLab\HtmlBuilder\HTML\Tag\Body;
use WabLab\HtmlBuilder\HTML\Tag\Head;
use WabLab\HtmlBuilder\HTML\Tag\Html;

class LayoutBuilder
{
    protected string $pageTitle = '';
    protected string $baseUrl = '';
    protected string $language = 'en';
    protected string $charset = 'UTF-8';
    protected string $favicon = '';
    protected string $metaDescription = '';
    protected string $metaKeywords = '';
    protected bool $isResponsive = true;
    protected array $externalCss = [];
    protected array $externalJs = [];
    protected array $headerComponents = [];
    protected array $mainComponents = [];
    protected array $footerComponents = [];

    /**
     * @return string
     */
    public function getPageTitle(): string
    {
        return $this->pageTitle;
    }

    public function setPageTitle(string $pageTitle): static
    {
        $this->pageTitle = $pageTitle;
        return $this;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function setBaseUrl(string $baseUrl): static
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): static
    {
        $this->language = $language;
        return $this;
    }

    public function getFavicon(): string
    {
        return $this->favicon;
    }

    public function setFavicon(string $favicon): static
    {
        $this->favicon = $favicon;
        return $this;
    }

    public function getCharset(): string
    {
        return $this->charset;
    }

    public function setCharset(string $charset): static
    {
        $this->charset = $charset;
        return $this;
    }

    public function getMetaDescription(): string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(string $metaDescription): static
    {
        $this->metaDescription = $metaDescription;
        return $this;
    }


    public function getMetaKeywords(): string
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords(string $metaKeywords): static
    {
        $this->metaKeywords = $metaKeywords;
        return $this;
    }


    public function isResponsive(): bool
    {
        return $this->isResponsive;
    }

    public function setIsResponsive(bool $isResponsive): static
    {
        $this->isResponsive = $isResponsive;
        return $this;
    }


    public function getExternalCss(): array
    {
        return $this->externalCss;
    }

    public function addExternalCss($cssPath):static
    {
        $this->externalCss[$cssPath] = $cssPath;
        return $this;
    }


    public function getExternalJs(): array
    {
        return $this->externalJs;
    }

    public function addExternalJs($jsPath):static
    {
        $this->externalJs[$jsPath] = $jsPath;
        return $this;
    }


    public function getHeaderComponents(): array
    {
        return $this->headerComponents;
    }

    public function addHeaderComponent($componenet):static
    {
        $this->headerComponents[] = $componenet;
    }

    public function getFooterComponents(): array
    {
        return $this->footerComponents;
    }

    public function addFooterComponent($component):static
    {
        $this->footerComponents[] = $component;
    }

    public function getMainComponents():array
    {
        return $this->mainComponents;
    }

    public function addMainComponent($component):static
    {
        return $this->mainComponents[] = $component;
    }


    //
    // LEVEL 0
    //
    public function build():Html
    {
        $html = Html::create()
            ->addChild(
                $this->initHeadElement()
            )
            ->addChild(
                $this->initBodyElement()
            );
        return $html;
    }


    //
    // LEVEL 1
    //
    protected function initHeadElement():Head
    {
        $head = Head::create();
        return $head;
    }

    protected function initBodyElement():Body
    {
        $body = Body::create();
        return $body;
    }

}

