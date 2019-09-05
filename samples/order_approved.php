<?php
require_once('vendor/autoload.php');

use \num8er\TranzWarePaymentGateway\TranzWarePaymentGatewayHandlerFactory;

$handlerFactory = new TranzWarePaymentGatewayHandlerFactory();
$orderCallbackHandler = $handlerFactory->createOrderCallbackHandler();

$orderStatusData = $orderCallbackHandler->handle();

var_dump($orderStatusData);
