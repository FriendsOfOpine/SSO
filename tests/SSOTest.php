<?php
namespace Foo;
use Opine\Container;
use PHPUnit_Framework_TestCase;

class SSOTest extends PHPUnit_Framework_TestCase {
    private $config;
    private $pubsub;
    private $route;
    private $service;

    public function setup () {
        $root = __DIR__ . '/../public';
        $container = new Container($root, $root . '/../container.yml');
        $this->config = $container->config;
        $configModel = $container->configModel;
        $configModel->build();
        $this->config->cacheSet([]);
        $this->pubsub = $container->pubsub;
        $this->route = $container->route;
        $this->service = $container->ssoService;
    }

    public function testConfigurationRead () {
        $this->assertTrue(is_object($this->config));
        $ssoConfig = $this->config->sso;
        $this->assertTrue(is_array($ssoConfig));
        $this->assertTrue(array_key_exists('providers', $ssoConfig));
    }

    public function testHybridauthIsService () {
    	$hybridauth = $this->service->instanceGet();
    	$this->assertTrue(is_object($hybridauth));
    }

    //test for redirect

    //test for response

    //test for topic published
}