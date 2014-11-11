<?php
namespace Foo\SSO;

class Route {
    private $route;

    public function __construct ($route) {
        $this->route = $route;
    }

    public function paths () {
        $this->route->get('/sso', 'ssoController@endpoint');
        $this->route->get('/sso/{provider}', 'ssoController@authenticate');
    }

    public static function location () {
        return __DIR__;
    }
}