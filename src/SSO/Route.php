<?php
namespace Foo\SSO;

class Route {
    private $route;

    public function __construct ($route) {
        $this->route = $route;
    }

    public function paths () {
        $this->route->get('/sso', 'ssoController@endpoint');
        $this->route->get('/sso/{provider}', 'ssoController@authenticateHTML');
        $this->route->get('/api/sso/{provider}', 'ssoController@authenticateJSON');
    }

    public static function location () {
        return __DIR__;
    }
}