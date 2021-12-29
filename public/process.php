<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\ProcessDataController;
use App\FileUploader;

$controller = new ProcessDataController(__DIR__ . '/config.yaml', new FileUploader());
$controller->process($_FILES);
