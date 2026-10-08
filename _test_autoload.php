<?php
require 'E:/MoskowNexus/vendor/autoload.php';

$helperExists = function_exists('asset_version');
$controllerExists = class_exists('App\Http\Controllers\WelcomeController');

echo "asset_version(): " . ($helperExists ? 'OK' : 'FAIL') . "\n";
echo "WelcomeController: " . ($controllerExists ? 'OK' : 'FAIL') . "\n";
