<?php

namespace num8er\TranzWarePaymentGateway\Handlers;

/**
 * Class that handles request from TWPG after approved/canceled/declined order creation on TWPG site
 *
 * Example:
 *  $data = TranzWarePaymentGatewayHandlerInterface::handle();
 *  var_dump($data); // --> array that consist of DatTime, OrderId, Amount, Currency, OrderStatus values
 *
 * Class TranzWarePaymentGatewayOrderCallbackHandler
 * @package num8er\TranzWarePaymentGateway\Handlers
 */
class TranzWarePaymentGatewayOrderCallbackHandler implements TranzWarePaymentGatewayHandlerInterface
{
    /**
     * Handles callback request and returns array of DatTime, OrderId, Amount, Currency, OrderStatus values
     *
     * @return array
     */
    final public static function handle()
    {
        $data = json_decode(
            json_encode(
                (array)simplexml_load_string($_REQUEST['xmlmsg'])
            ),
            false
        );
        return [
            'DateTime'      => $data->TranDateTime,
            'OrderId'       => $data->OrderID,
            'Amount'        => $data->PurchaseAmount,
            'Currency'      => $data->Currency,
            'OrderStatus'   => $data->OrderStatus
        ];
    }
}