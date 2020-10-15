<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('vendor/autoload.php');

use \num8er\TranzWarePaymentGateway\TranzWarePaymentGatewayRequestFactory;
use \num8er\TranzWarePaymentGateway\CurrencyCodes;

$requestFactory = new TranzWarePaymentGatewayRequestFactory(
    'https://tranz-ware-payment-gateway/url',
    'E1000010',
    'https://your-site-address-here/samples/order_approved.php',
    'https://your-site-address-here/samples/order_declined.php',
    'https://your-site-address-here/samples/order_canceled.php',
    'EN'
);
$keyFile = __DIR__.'/certificates/your-private-key.pem';
$keyPass = file_get_contents(__DIR__.'/certificates/your-private-key-pass.txt');
$certFile = __DIR__.'/certificates/cert-signed-by-payment-gateway-part.crt';
$requestFactory->setCertificate($certFile, $keyFile, $keyPass);
$requestFactory->setDebugFile(__DIR__.'/debug.log');

$orderRequest = $requestFactory->createOrderRequest(1, CurrencyCodes::USD, 'TEST PAYMENT $0.01');
$orderRequestResult = $orderRequest->execute();
if ($orderRequestResult->success()) {
    $orderData = $orderRequestResult->getData();
    echo '<a href="'.$orderData['PaymentUrl'].'">LINK TO PAYMENT</a>';
    exit(0);
}

echo 'FAILED';
