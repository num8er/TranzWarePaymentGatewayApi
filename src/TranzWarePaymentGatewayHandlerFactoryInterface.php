<?php

namespace num8er\TranzWarePaymentGateway;

use \num8er\TranzWarePaymentGateway\Handlers\TranzWarePaymentGatewayHandlerInterface;

/**
 * Interface TranzWarePaymentGatewayHandlerFactoryInterface
 * @package num8er\TranzWarePaymentGateway
 */
interface TranzWarePaymentGatewayHandlerFactoryInterface
{
    /**
     * Returns a new instance of TranzWarePaymentGatewayHandlerInterface
     * that will handle callbacks after order creation
     *
     * @return TranzWarePaymentGatewayHandlerInterface
     */
    public function createOrderCallbackHandler();
}