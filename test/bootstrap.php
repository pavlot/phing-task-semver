<?php

use Phing\Phing ;

defined('PHING_TEST_BASE') || define('PHING_TEST_BASE', dirname(__FILE__).'/../vendor/phing/phing/tests');

set_include_path(
    realpath(PHING_TEST_BASE) . PATH_SEPARATOR .
    realpath(PHING_TEST_BASE . '/../classes') . PATH_SEPARATOR .
    realpath(PHING_TEST_BASE . '/classes') . PATH_SEPARATOR .
    realpath(PHING_TEST_BASE . '/../src') . PATH_SEPARATOR .
    realpath(PHING_TEST_BASE . '/src') . PATH_SEPARATOR .
    get_include_path()  // trunk version of phing classes should take precedence
);

// Use composers autoload.php if available
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/../../../autoload.php')) {
    require_once __DIR__ . '/../../../autoload.php';
}

Phing::setProperty('phing.home', realpath(dirname(__FILE__).'/../vendor/phing/phing'));
Phing::startup();

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_STRICT);
