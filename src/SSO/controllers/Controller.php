<?php
namespace Foo\SSO;

class Controller {
    private $service;
    private $topic;
    private $model;
    private $view;

    public function __construct ($service, $topic, $model, $view) {
        $this->service = $service;
        $this->topic = $topic;
        $this->model = $model;
        $this->view = $view;
    }

    public function redirect () {
        var_dump($_REQUEST);
    }

    public function authenticateHTML ($provider) {
        $this->authenticate($provider);
    }

    public function authenticateJSON ($provider) {
        $this->authenticate($provider);
    }

    private function authenticate ($provider) {
        $adapter = $this->service->authenticate($provider);
        $profile = $adapter->getUserProfile();
        var_dump($profile);
        exit;
        $context = [
            'profile' => $profile
        ];
        $this->topic->publish('sso-login', $context);
    }
}