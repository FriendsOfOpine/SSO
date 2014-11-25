<?php
namespace Foo\SSO;
use Exception;
use Upload\FileInfo;

class Model {
    private $person;

    public function __construct ($person) {
        $this->person = $person;
    }

    public function login ($context) {
        if (!isset($context['profile'])) {
            throw Exception('profile not in context');
        }
        $profile = (array)$context['profile'];

        if (!isset($profile['email'])) {
            throw new Exception('email not in profile');
        }

        $found = $this->person->findByEmail($profile['email']);
        if ($found === false) {
            $attributes = [
                'email'         => $profile['email'],
                'first_name'    => isset($profile['firstName']) ? $profile['firstName'] : null,
                'last_name'     => isset($profile['lastName']) ? $profile['lastName'] : null,
                'groups'        => ['public'],
                'image'         => isset($profile['photoURL']) ? $this->imagePathToArray($profile['photoURL']) : null
            ];
            $this->person->create($attributes);
        }
        $this->person->ssoProviderAdd($context['provider'], $context['profile']);
        $this->person->sessionSave($context['provider']);
    }

    private function imagePathToArray ($url) {
        $tmpUrl = $url;
        if (substr_count($url, '?') > 0) {
            $tmpUrl = explode('?', $tmpUrl, 2);
            $tmpUrl = $tmpUrl[1];
            $end = substr($tmpUrl, -5);
        } else {
            $end = substr($url, -5);
        }
        $tmpPath = '/tmp/' . uniqid() . $end;
        file_put_contents($tmpPath, file_get_contents($url));
        $fileinfo = new FileInfo($tmpPath);
        $image = [
            'name'      => $fileinfo->getNameWithExtension(),
            'type'      => $fileinfo->getMimetype(),
            'size'      => $fileinfo->getSize(),
            'md5'       => $fileinfo->getMd5(),
            'width'     => $fileinfo->getDimensions()['width'],
            'height'    => $fileinfo->getDimensions()['height'],
            'url'       => $url
        ];
        unlink($tmpPath);
        return $image;
    }
}