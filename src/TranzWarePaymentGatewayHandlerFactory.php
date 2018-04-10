<?php

namespace num8er\TranzWarePaymentGateway;

use num8er\TranzWarePaymentGateway\Handlers\TranzWarePaymentGatewayOrderCallbackHandler;

/**
 * Class TranzWarePaymentGatewayHandlerFactory
 * @package num8er\TranzWarePaymentGateway
 */
class TranzWarePaymentGatewayHandlerFactory implements TranzWarePaymentGatewayHandlerFactoryInterface
{
    /**
     * @return Handlers\TranzWarePaymentGatewayOrderCallbackHandler
     */
    final public function createOrderCallbackHandler()
    {
        return new TranzWarePaymentGatewayOrderCallbackHandler();
    }
}