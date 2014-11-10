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

    public function endpoint () {
        $this->service->endpoint();
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
        $context = [
            'profile' => $profile
        ];
        $this->topic->publish('sso-login', $context);
    }
}