<?php

namespace num8er\TranzWarePaymentGateway\Handlers;

class TranzWarePaymentGatewayOrderCallbackHandler implements TranzWarePaymentGatewayHandlerInterface
{
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