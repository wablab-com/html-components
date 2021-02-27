<?php

namespace WabLab\Tests;

use PHPUnit\Framework\TestCase;

class AbstractTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        //$this->setOutputCallback(function() {});
    }
}