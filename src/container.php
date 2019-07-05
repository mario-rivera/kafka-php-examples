<?php
require dirname(__DIR__, 1) . '/vendor/autoload.php';

$definitions = dirname(__DIR__, 1) . '/config/definitions.php';
$container = (new \DI\ContainerBuilder())->addDefinitions($definitions)->build();

return $container;