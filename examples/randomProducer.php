<?php
$container = require_once dirname(__DIR__, 1) . '/src/container.php';

$producer = $container->get(\App\RandomNames\NamesProducer::class);
$producer->produce();
