<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__.'/../vendor/autoload.php');

use num8er\TranzWarePaymentGateway\Handlers\TranzWarePaymentGatewayOrderCallbackHandler;

$orderStatusData = TranzWarePaymentGatewayOrderCallbackHandler::handle();

var_dump($orderStatusData);
