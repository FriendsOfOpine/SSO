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

    public function authenticate ($provider) {
        $adapter = $this->service->authenticate($provider);
        $profile = $adapter->getUserProfile();
        $context = [
            'profile' => $profile,
            'provider' => $provider
        ];
        $this->topic->publish('sso-authenticate', $context);
    }
}