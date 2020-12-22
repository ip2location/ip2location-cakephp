<?php

declare(strict_types=1);

if (!$loader = @include './vendor/autoload.php') {
    die('Project dependencies missing');
}

$loader->add('IP2LocationCakePHP\Test', __DIR__);