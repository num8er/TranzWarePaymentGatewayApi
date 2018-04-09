<?php

namespace num8er\TranzWarePaymentGateway;
use num8er\TranzWarePaymentGateway\Requests\TranzWarePaymentGatewayRequestInterface;

/**
 * Interface TranzWarePaymentGatewayRequestFactoryInterface
 * @package num8er\TranzWarePaymentGateway
 */
interface TranzWarePaymentGatewayRequestFactoryInterface
{
    /**
     * TranzWarePaymentGatewayRequestFactoryInterface constructor.
     *
     * @param string $GATEWAY_URL
     * @param string $MERCHANT_ID
     * @param string $ON_ORDER_APPROVED_URL
     * @param string $ON_ORDER_DECLINED_URL
     * @param string $ON_ORDER_CANCELED_URL
     * @param string $LANG
     */
    public function __construct($GATEWAY_URL, $MERCHANT_ID, $ON_ORDER_APPROVED_URL, $ON_ORDER_DECLINED_URL, $ON_ORDER_CANCELED_URL, $LANG = 'EN');

    /**
     * @param float  $amount
     * @param string $currency
     * @param string $description
     *
     * @return TranzWarePaymentGatewayRequestInterface
     */
    public function createOrderRequest($amount, $currency, $description = '');

    /**
     * @param string $orderId
     * @param string $sessionId
     *
     * @return TranzWarePaymentGatewayRequestInterface
     */
    public function createOrderStatusRequest($orderId, $sessionId);
}