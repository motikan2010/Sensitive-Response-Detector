<?php

namespace Motikan2010\SensitiveResponseDetector\Tests;



use Motikan2010\SensitiveResponseDetector\Middleware\DetectSensitiveResponse;

class DetectSensitiveResponseTest extends TestCase
{

    public function testCheckIp()
    {
        $response = (new DetectSensitiveResponse())->handle($this->app->request, function () {
            return $this->get('/')->setStatusCode(200)->setContent('<html><p>192.168.1.1</p></html>');
        });

        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testCheckEmail()
    {
        $response = (new DetectSensitiveResponse())->handle($this->app->request, function () {
            return $this->get('/')->setStatusCode(200)->setContent('<html><p>info@example.com</p></html>');
        });

        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testNoDetect()
    {
        $response = (new DetectSensitiveResponse())->handle($this->app->request, function () {
            return $this->get('/')->setStatusCode(200)->setContent('<html><p>Hello, World!!</p></html>');
        });

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDisableCheckIp()
    {
        config(['detector.enabled' => false]);

        $response = (new DetectSensitiveResponse())->handle($this->app->request, function () {
            return $this->get('/')->setStatusCode(200)->setContent('<html><p>192.168.1.1</p></html>');
        });

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDetectRedirect()
    {
        config(['detector.block.redirect' => 'http://example.com']);

        $response = (new DetectSensitiveResponse())->handle($this->app->request, function () {
            return $this->get('/')->setStatusCode(200)->setContent('<html><p>192.168.1.1</p></html>');
        });

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('http://example.com', $response->getTargetUrl());
    }

}
