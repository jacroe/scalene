<?php
require "scalene/Scalene.php";

$app = Scalene::instance();
$app->build();
$app->router->route();