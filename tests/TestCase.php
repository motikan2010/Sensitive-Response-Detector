<?php

namespace Motikan2010\SensitiveResponseDetector\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpConfig();
    }

    protected function setUpConfig()
    {
        config(['detector' => require __DIR__ . '/../src/Config/detector.php']);
    }

}
