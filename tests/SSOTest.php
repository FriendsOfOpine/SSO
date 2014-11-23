<?php
namespace Foo;
use Opine\Container\Service as Container;
use Opine\Config\Service as Config;
use PHPUnit_Framework_TestCase;

class SSOTest extends PHPUnit_Framework_TestCase {
    private $config;
    private $pubsub;
    private $route;
    private $service;

    public function setup () {
        $root = __DIR__ . '/../public';
        $this->config = new Config($root);
        $this->config->cacheSet();
        $container = new Container($root, $this->config, $root . '/../container.yml');
        $this->service = $container->get('ssoService');
    }

    public function testConfigurationRead () {
        $this->assertTrue(is_object($this->config));
        $ssoConfig = $this->config->get('sso');
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