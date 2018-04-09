<?php

namespace num8er\TranzWarePaymentGateway;

interface TranzWarePaymentGatewayRequestFactoryInterface
{
    public function __construct($GATEWAY_URL, $MERCHANT_ID, $ON_ORDER_APPROVED_URL, $ON_ORDER_DECLINED_URL, $ON_ORDER_CANCELED_URL, $LANG = 'EN');

    public function createOrderRequest($amount, $currency, $description = '');

    public function createOrderStatusRequest($orderId, $sessionId);
}