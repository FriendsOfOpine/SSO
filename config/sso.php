<?php
return [
    'base_url' => 'http://mywebsite/path/to/hybridauth/',
    'providers' => [
        'Facebook' => [
            'enabled' => true,
            'keys' => ['id' => '', 'secret' => ''],
            'scope' => 'email, user_about_me, user_birthday, user_hometown'
        ]
    ],
    'debug_mode' => true,
    'debug_file' => __DIR__ . '/../var/cache/ha-log.txt'
];