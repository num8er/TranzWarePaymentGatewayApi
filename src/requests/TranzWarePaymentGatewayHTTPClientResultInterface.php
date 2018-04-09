<?php

namespace num8er\TranzWarePaymentGateway\Requests;

interface TranzWarePaymentGatewayHTTPClientResultInterface
{
    public function __construct($output, $info);

    /**
     * Returns request info (headers, status and etc)
     *
     * @return mixed
     */
    public function getInfo();

    /**
     * Returns raw http output
     *
     * @return mixed
     */
    public function getOutput();
}