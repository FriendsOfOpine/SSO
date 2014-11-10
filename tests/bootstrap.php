<?php
session_start();
date_default_timezone_set('UTC');
require_once __DIR__ . '/../vendor/autoload.php';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['REQUEST_URI'] = '/';