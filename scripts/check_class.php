<?php
require __DIR__ . '/../vendor/autoload.php';
var_dump(class_exists('App\\Http\\Controllers\\SistemaController'));
$rc = new ReflectionClass('App\\Http\\Controllers\\SistemaController');
print_r($rc->getFileName());
