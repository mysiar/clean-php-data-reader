<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\HomeController;

$home = new HomeController();
$home->index();
